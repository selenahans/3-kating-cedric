<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\UserInventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
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
                ]);
            }
        });

        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dibeli!',
            'coins' => (int) $user->coins,
            'item_name' => $item->name,
            'item_id' => $item->id,
        ]);
    }
}
