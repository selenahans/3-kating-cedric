<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ReadingLog;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\UserInventory;
use App\Models\UserPet;
use App\Services\TaskAutoCompletionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class MyPetController extends Controller
{
    private const FOOD_GAIN_MAP = [
        'Organic Apple' => 15,
        'Sweet Honey' => 20,
        'Magical Berry' => 25,
        'Crispy Leaf' => 30,
    ];

    private const FOOD_ICON_MAP = [
        'Organic Apple' => '🍎',
        'Sweet Honey' => '🍯',
        'Magical Berry' => '🫐',
        'Crispy Leaf' => '🌿',
    ];

    private function minimumCoinsForLevel(int $level): int
    {
        $normalizedLevel = max(1, $level);
        // Level 1 gets 100. From level 2 onward, reward is 10 * level.
        return 100 + (int) (10 * ((($normalizedLevel * ($normalizedLevel + 1)) / 2) - 1));
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        app(TaskAutoCompletionService::class)->syncForUser((int) $user->id);

        $totalPagesRead = (int) ReadingLog::where('user_id', $user->id)->sum('pages_read');
        $pet = UserPet::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nickname' => $user->name,
                'type' => 'owl',
                'xp' => 0,
                'stage' => 'baby',
                'health' => 100,
                'happiness' => 100,
            ]
        );

        $xpPerPage = 5;
        $xpPerLevel = 100;

        $totalXp = $totalPagesRead * $xpPerPage;
        $level = intdiv($totalXp, $xpPerLevel) + 1;
        $xpInCurrentLevel = $totalXp % $xpPerLevel;

        // Level 1 tuning requested: +10 knowledge, -3 kenyang, +3 happiness per page.
        $knowledgePercent = min(100, $totalPagesRead * 10);
        $kenyangPercent = max(0, min(100, (int) ($pet->health ?? 100)));
        $happinessPercent = min(100, $totalPagesRead * 3);
        $expPercent = (int) round(($xpInCurrentLevel / $xpPerLevel) * 100);

        $growthTitle = match (true) {
            $level >= 8 => 'Adult',
            $level >= 4 => 'Teen',
            default => 'Baby',
        };

        $minimumCoins = $this->minimumCoinsForLevel($level);
        if ((int) ($user->coins ?? 0) < $minimumCoins) {
            $user->coins = $minimumCoins;
            $user->save();
        }

        $petStats = [
            ['label' => 'Kenyang', 'val' => $kenyangPercent . '%', 'color' => 'bg-biblo-clay', 'width' => $kenyangPercent . '%'],
            ['label' => 'Happiness', 'val' => $happinessPercent . '%', 'color' => 'bg-biblo-sage', 'width' => $happinessPercent . '%'],
            ['label' => 'Knowledge', 'val' => $knowledgePercent . '%', 'color' => 'bg-biblo-moss', 'width' => $knowledgePercent . '%'],
            ['label' => 'Exp', 'val' => $xpInCurrentLevel . '/' . $xpPerLevel, 'color' => 'bg-biblo-charcoal', 'width' => $expPercent . '%'],
        ];

        $appleQty = 0;
        $honeyQty = 0;
        $petFoodItems = [];
        $petImage = asset('images/boo-pet.webp');
        $activeSkinName = 'Default';
        if (Schema::hasTable('items') && Schema::hasTable('user_inventory') && Schema::hasColumn('user_inventory', 'quantity')) {
            $appleItem = Item::where('name', 'Organic Apple')->first();
            $honeyItem = Item::where('name', 'Sweet Honey')->first();

            $foodItems = Item::where('type', 'food')
                ->orderBy('level_gate')
                ->orderBy('id')
                ->get();

            $foodQtyByItemId = UserInventory::where('user_id', $user->id)
                ->selectRaw('item_id, SUM(quantity) as total_qty')
                ->groupBy('item_id')
                ->pluck('total_qty', 'item_id');

            $petFoodItems = $foodItems->map(function (Item $item) use ($foodQtyByItemId) {
                $qty = (int) ($foodQtyByItemId[$item->id] ?? 0);

                return [
                    'id' => (int) $item->id,
                    'name' => (string) $item->name,
                    'icon' => self::FOOD_ICON_MAP[$item->name] ?? '🍽️',
                    'qty' => $qty,
                ];
            })->values();

            if (Schema::hasColumn('user_inventory', 'is_equipped')) {
                $equippedSkin = UserInventory::with('item')
                    ->where('user_id', $user->id)
                    ->where('is_equipped', true)
                    ->whereHas('item', function ($query) {
                        $query->where('type', 'skin');
                    })
                    ->first();

                $skinImagePath = $equippedSkin?->item?->image_path;
                if (!empty($skinImagePath) && is_file(public_path($skinImagePath))) {
                    $petImage = asset($skinImagePath);
                    $activeSkinName = (string) ($equippedSkin?->item?->name ?? 'Default');
                }
            }

            if ($appleItem) {
                $appleQty = (int) UserInventory::where('user_id', $user->id)
                    ->where('item_id', $appleItem->id)
                    ->sum('quantity');
            }

            if ($honeyItem) {
                $honeyQty = (int) UserInventory::where('user_id', $user->id)
                    ->where('item_id', $honeyItem->id)
                    ->sum('quantity');
            }
        }

        // Show tasks for the next gated level-up (3, 6, 9, ...).
        $nextGateLevel = (int) (ceil(($level + 1) / 3) * 3);
        $gateTasks = Task::where('level_gate', $nextGateLevel)->get()->map(function (Task $task) use ($user) {
            $completed = TaskCompletion::where('user_id', $user->id)
                ->where('task_id', $task->id)
                ->exists();

            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'coin_reward' => (int) $task->coin_reward,
                'xp_reward' => (int) $task->xp_reward,
                'completed' => $completed,
            ];
        });

        $gateCompletedCount = $gateTasks->where('completed', true)->count();
        $gateTotalCount = $gateTasks->count();

        return view('mypet', [
            'petLevel' => $level,
            'growthTitle' => $growthTitle,
            'petStats' => $petStats,
            'appleQty' => $appleQty,
            'honeyQty' => $honeyQty,
            'petImage' => $petImage,
            'activeSkinName' => $activeSkinName,
            'petFoodItems' => $petFoodItems,
            'canFeed' => $kenyangPercent < 90,
            'nextGateLevel' => $nextGateLevel,
            'gateTasks' => $gateTasks,
            'gateCompletedCount' => $gateCompletedCount,
            'gateTotalCount' => $gateTotalCount,
        ]);
    }

    public function feed(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'item' => ['nullable', 'string'],
            'item_name' => ['nullable', 'string'],
        ]);

        if (!$request->filled('item') && !$request->filled('item_name')) {
            return response()->json([
                'success' => false,
                'message' => 'Item makanan belum dipilih.',
            ], 422);
        }

        if (!Schema::hasTable('items') || !Schema::hasTable('user_inventory') || !Schema::hasColumn('user_inventory', 'quantity')) {
            return response()->json([
                'success' => false,
                'message' => 'Inventory belum siap.',
            ], 422);
        }

        $legacyItemMap = [
            'apple' => 'Organic Apple',
            'honey' => 'Sweet Honey',
        ];

        $itemName = (string) ($validated['item_name'] ?? '');
        if ($itemName === '' && !empty($validated['item']) && isset($legacyItemMap[$validated['item']])) {
            $itemName = $legacyItemMap[$validated['item']];
        }

        $item = Item::where('name', $itemName)
            ->where('type', 'food')
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan.',
            ], 404);
        }

        $pet = UserPet::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nickname' => $user->name,
                'type' => 'owl',
                'xp' => 0,
                'stage' => 'baby',
                'health' => 100,
                'happiness' => 100,
            ]
        );

        if ((int) $pet->health >= 90) {
            return response()->json([
                'success' => false,
                'message' => 'Pet sudah kenyang, belum bisa dikasih makan dulu.',
                'kenyang' => (int) $pet->health,
            ], 422);
        }

        $totalQty = (int) UserInventory::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->sum('quantity');

        if ($totalQty <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Stok item habis.',
                'kenyang' => (int) $pet->health,
            ], 422);
        }

        $gain = (int) (self::FOOD_GAIN_MAP[$item->name] ?? 15);

        DB::transaction(function () use ($user, $item, $gain, $pet) {
            $row = UserInventory::where('user_id', $user->id)
                ->where('item_id', $item->id)
                ->where('quantity', '>', 0)
                ->orderBy('id')
                ->lockForUpdate()
                ->firstOrFail();

            $row->quantity -= 1;
            $row->save();

            $pet->health = min(100, (int) $pet->health + $gain);
            $pet->save();
        });

        $foodQuantities = UserInventory::query()
            ->join('items', 'items.id', '=', 'user_inventory.item_id')
            ->where('user_inventory.user_id', $user->id)
            ->where('items.type', 'food')
            ->selectRaw('items.name as item_name, SUM(user_inventory.quantity) as total_qty')
            ->groupBy('items.name')
            ->pluck('total_qty', 'item_name')
            ->map(fn ($qty) => (int) $qty)
            ->all();

        return response()->json([
            'success' => true,
            'message' => 'Pet berhasil diberi makan.',
            'kenyang' => (int) $pet->fresh()->health,
            'food_quantities' => $foodQuantities,
            'item_name' => $item->name,
            'can_feed' => ((int) $pet->fresh()->health) < 90,
        ]);
    }

    public function getStatus(Request $request): JsonResponse
    {
        $user = $request->user();
        $pet = UserPet::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nickname' => $user->name,
                'type' => 'owl',
                'xp' => 0,
                'stage' => 'baby',
                'health' => 100,
                'happiness' => 100,
            ]
        );

        return response()->json([
            'success' => true,
            'health' => (int) $pet->health,
            'is_hungry' => (int) $pet->health < 30,
        ]);
    }
}
