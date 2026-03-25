<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\UserInventory;
use App\Models\ReadingLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    private const SKIN_CATALOG = [
        [
            'name' => 'Original',
            'label' => 'Asli',
            'price' => 0,
            'desc' => 'Tampilan default Biblo. Selalu gratis dan bisa digunakan kapan saja.',
            'icon' => '✨',
            'preview_color' => 'bg-biblo-oat',
            'image_path' => 'images/skins/biblo-ori.webp',
            'slug' => 'biblo-ori',
            'is_default' => true,
        ],
        [
            'name' => 'Classic Oat',
            'label' => 'Oat Klasik',
            'price' => 60,
            'desc' => 'Palet oat hangat khas Biblo.',
            'icon' => '🤍',
            'preview_color' => 'bg-biblo-oat',
            'image_path' => 'images/skins/biblo-oat.webp',
            'slug' => 'biblo-oat',
        ],
        [
            'name' => 'Sage Bloom',
            'label' => 'Mekar Sage',
            'price' => 75,
            'desc' => 'Nuansa sage lembut terinspirasi UI Biblo.',
            'icon' => '🌿',
            'preview_color' => 'bg-biblo-sage/30',
            'image_path' => 'images/skins/biblo-sage.webp',
            'slug' => 'biblo-sage',
        ],
        [
            'name' => 'Moss Forest',
            'label' => 'Hutan Moss',
            'price' => 85,
            'desc' => 'Palet moss alami untuk tampilan menenangkan.',
            'icon' => '🌲',
            'preview_color' => 'bg-biblo-moss/30',
            'image_path' => 'images/skins/biblo-moss.webp',
            'slug' => 'biblo-moss',
        ],
        [
            'name' => 'Clay Sunset',
            'label' => 'Senja Clay',
            'price' => 90,
            'desc' => 'Nuansa clay hangat dengan vibe senja.',
            'icon' => '🧡',
            'preview_color' => 'bg-biblo-clay/30',
            'image_path' => 'images/skins/biblo-clay.webp',
            'slug' => 'biblo-clay',
        ],
        [
            'name' => 'Greige Mist',
            'label' => 'Kabut Greige',
            'price' => 70,
            'desc' => 'Greige netral untuk gaya minimalis.',
            'icon' => '☁️',
            'preview_color' => 'bg-biblo-greige/30',
            'image_path' => 'images/skins/biblo-greige.webp',
            'slug' => 'biblo-greige',
        ],
        [
            'name' => 'Charcoal Night',
            'label' => 'Malam Charcoal',
            'price' => 100,
            'desc' => 'Gaya charcoal pekat untuk mood berani.',
            'icon' => '🌙',
            'preview_color' => 'bg-biblo-charcoal/20',
            'image_path' => 'images/skins/biblo-charcoal.webp',
            'slug' => 'biblo-charcoal',
        ],
    ];

    private const FOOD_CATALOG = [
        [
            'name' => 'Organic Apple',
            'label' => 'Apel Organik',
            'price' => 10,
            'desc' => 'Segar dan bergizi',
            'icon' => '🍎',
            'color' => 'bg-orange-50',
            'level_gate' => 1,
            'image_path' => 'images/items/food-organic-apple.webp',
        ],
        [
            'name' => 'Sweet Honey',
            'label' => 'Madu Manis',
            'price' => 15,
            'desc' => 'Energi cair berwarna emas',
            'icon' => '🍯',
            'color' => 'bg-amber-50',
            'level_gate' => 3,
            'image_path' => 'images/items/food-sweet-honey.webp',
        ],
        [
            'name' => 'Magical Berry',
            'label' => 'Berry Ajaib',
            'price' => 30,
            'desc' => 'Buah berry ungu yang mistis',
            'icon' => '🫐',
            'color' => 'bg-indigo-50',
            'level_gate' => 6,
            'image_path' => 'images/items/food-magical-berry.webp',
        ],
        [
            'name' => 'Crispy Leaf',
            'label' => 'Daun Renyah',
            'price' => 50,
            'desc' => 'Esensi daun kuno',
            'icon' => '🌿',
            'color' => 'bg-emerald-50',
            'level_gate' => 10,
            'image_path' => 'images/items/food-crispy-leaf.webp',
        ],
    ];

    public function index(Request $request)
    {
        $user = $request->user();
        $this->ensureSkinItems($user->id);
        $this->ensureFoodItems();

        $catalogByName = collect(self::SKIN_CATALOG)->keyBy('name');
        $foodCatalogByName = collect(self::FOOD_CATALOG)->keyBy('name');
        $inventoryByItemId = UserInventory::where('user_id', $user->id)
            ->get()
            ->keyBy('item_id');

        $skinsItems = Item::where('type', 'skin')
            ->orderBy('price')
            ->get()
            ->map(function (Item $item) use ($inventoryByItemId, $catalogByName) {
                $inventory = $inventoryByItemId->get($item->id);
                $catalog = $catalogByName->get($item->name, []);

                return [
                    'name' => $item->name,
                    'label' => (string) ($catalog['label'] ?? $item->name),
                    'price' => (int) $item->price,
                    'icon' => (string) ($catalog['icon'] ?? '🎨'),
                    'desc' => (string) ($catalog['desc'] ?? 'Palet skin Biblo.'),
                    'color' => (string) ($catalog['preview_color'] ?? 'bg-biblo-oat'),
                    'image_path' => (string) ($catalog['image_path'] ?? 'images/skins/biblo-ori.webp'),
                    'owned' => $inventory !== null && (int) $inventory->quantity > 0,
                    'equipped' => $inventory !== null && (bool) $inventory->is_equipped,
                ];
            })
            ->values();

        $totalPagesRead = ReadingLog::where('user_id', $user->id)->sum('pages_read') ?? 0;
        $petLevel = intdiv($totalPagesRead * 5, 100) + 1;

        $foodItems = Item::where('type', 'food')
            ->orderBy('level_gate')
            ->get()
            ->map(function (Item $item) use ($inventoryByItemId, $foodCatalogByName, $petLevel) {
                $inventory = $inventoryByItemId->get($item->id);
                $catalog = $foodCatalogByName->get($item->name, []);

                return [
                    'name' => $item->name,
                    'label' => (string) ($catalog['label'] ?? $item->name),
                    'price' => (int) $item->price,
                    'icon' => (string) ($catalog['icon'] ?? '🍎'),
                    'desc' => (string) ($catalog['desc'] ?? 'Item makanan pet.'),
                    'color' => (string) ($catalog['color'] ?? 'bg-orange-50'),
                    'level_gate' => (int) $item->level_gate,
                    'quantity' => $inventory !== null ? (int) $inventory->quantity : 0,
                    'locked' => $item->level_gate > $petLevel,
                ];
            })
            ->values();

        return view('shop', [
            'skinsItems' => $skinsItems,
            'foodItems' => $foodItems,
        ]);
    }

    public function purchase(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'item_name' => ['required', 'string'],
        ]);

        if (!Schema::hasTable('items') || !Schema::hasTable('user_inventory')) {
            return response()->json([
                'success' => false,
                'message' => 'Inventory sistem belum siap.',
            ], 422);
        }

        $item = Item::where('name', $validated['item_name'])->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan.',
            ], 404);
        }

        $owned = UserInventory::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();

        if ($item->type === 'skin' && $owned && (int) $owned->quantity > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Skin sudah dimiliki.',
                'coins' => (int) ($user->coins ?? 0),
                'item_name' => $item->name,
                'item_id' => $item->id,
                'item_type' => $item->type,
                'already_owned' => true,
            ]);
        }

        $currentCoins = (int) ($user->coins ?? 0);

        if ($currentCoins < $item->price) {
            return response()->json([
                'success' => false,
                'message' => 'Koin tidak cukup untuk membeli item ini.',
                'coins' => $currentCoins,
                'price' => $item->price,
                'needed' => $item->price - $currentCoins,
            ], 422);
        }

        // Calculate user's pet level based on pages read
        $totalPagesRead = ReadingLog::where('user_id', $user->id)->sum('pages_read') ?? 0;
        $petLevel = intdiv($totalPagesRead * 5, 100) + 1;

        // Check level gate requirement
        if ($item->level_gate && $item->level_gate > $petLevel) {
            return response()->json([
                'success' => false,
                'message' => 'Item ini tersedia saat level ' . $item->level_gate . '. Level kamu sekarang: ' . $petLevel,
                'required_level' => $item->level_gate,
                'current_level' => $petLevel,
            ], 422);
        }

        DB::transaction(function () use ($user, $item) {
            // Deduct coins
            $user->coins = max(0, (int) $user->coins - $item->price);
            $user->save();

            // Add to inventory
            $existing = UserInventory::where('user_id', $user->id)
                ->where('item_id', $item->id)
                ->first();

            if ($existing) {
                $existing->quantity += 1;
                $existing->save();
            } else {
                UserInventory::create([
                    'user_id' => $user->id,
                    'item_id' => $item->id,
                    'quantity' => 1,
                    'is_equipped' => $item->type === 'skin' ? true : false,
                ]);
            }

            // Auto-equip if it's a skin
            if ($item->type === 'skin') {
                UserInventory::where('user_id', $user->id)
                    ->where('is_equipped', true)
                    ->where('item_id', '!=', $item->id)
                    ->update(['is_equipped' => false]);

                $inv = UserInventory::where('user_id', $user->id)
                    ->where('item_id', $item->id)
                    ->first();
                if ($inv) {
                    $inv->is_equipped = true;
                    $inv->save();
                }
            }
        });

        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dibeli!',
            'coins' => (int) $user->coins,
            'item_name' => $item->name,
            'item_id' => $item->id,
            'item_type' => $item->type,
        ]);
    }

    public function equipSkin(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'item_name' => ['required', 'string'],
        ]);

        if (!Schema::hasTable('items') || !Schema::hasTable('user_inventory')) {
            return response()->json([
                'success' => false,
                'message' => 'Inventory sistem belum siap.',
            ], 422);
        }

        $item = Item::where('name', $validated['item_name'])
            ->where('type', 'skin')
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Skin tidak ditemukan.',
            ], 404);
        }

        $owned = UserInventory::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();

        if (!$owned || (int) $owned->quantity <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Skin belum dimiliki.',
            ], 422);
        }

        DB::transaction(function () use ($user, $owned) {
            UserInventory::where('user_id', $user->id)
                ->where('is_equipped', true)
                ->update(['is_equipped' => false]);

            $owned->is_equipped = true;
            $owned->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'Skin berhasil dipakai.',
            'item_name' => $item->name,
        ]);
    }

    private function ensureSkinItems(int $userId): void
    {
        $defaultSkinName = self::SKIN_CATALOG[0]['name'];
        $defaultSkinInventory = null;

        foreach (self::SKIN_CATALOG as $skin) {
            $item = Item::firstOrCreate(
                ['name' => $skin['name']],
                [
                    'type' => 'skin',
                    'price' => $skin['price'],
                    'image_path' => $skin['image_path'],
                ]
            );

            $item->type = 'skin';
            $item->price = $skin['price'];
            $item->image_path = $skin['image_path'];
            $item->save();

            if ($skin['name'] === $defaultSkinName) {
                $defaultSkinInventory = UserInventory::firstOrCreate(
                    [
                        'user_id' => $userId,
                        'item_id' => $item->id,
                    ],
                    [
                        'quantity' => 1,
                        'is_equipped' => true,
                    ]
                );

                if ((int) $defaultSkinInventory->quantity < 1) {
                    $defaultSkinInventory->quantity = 1;
                    $defaultSkinInventory->save();
                }
            }
        }

        $equippedExists = UserInventory::where('user_id', $userId)
            ->where('is_equipped', true)
            ->exists();

        if (!$equippedExists && $defaultSkinInventory) {
            $defaultSkinInventory->is_equipped = true;
            $defaultSkinInventory->save();
        }
    }

    private function ensureFoodItems(): void
    {
        foreach (self::FOOD_CATALOG as $food) {
            $item = Item::firstOrCreate(
                ['name' => $food['name']],
                [
                    'type' => 'food',
                    'price' => $food['price'],
                    'level_gate' => $food['level_gate'],
                    'image_path' => $food['image_path'],
                ]
            );

            $item->type = 'food';
            $item->price = $food['price'];
            $item->level_gate = $food['level_gate'];
            $item->image_path = $food['image_path'];
            $item->save();
        }
    }
}
