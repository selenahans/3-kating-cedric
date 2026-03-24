<?php

namespace App\Providers;

use App\Models\ReadingLog;
use App\Models\Item;
use App\Models\User;
use App\Models\UserInventory;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private function minimumCoinsForLevel(int $level): int
    {
        $normalizedLevel = max(1, $level);
        return 100 + (int) (10 * ((($normalizedLevel * ($normalizedLevel + 1)) / 2) - 1));
    }

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $unreadNotificationCount = 0;
            $currentPetName = null;
            $currentCoins = 0;
            $starterAppleQty = 0;
            $starterHoneyQty = 0;

            if (Auth::check()) {
                $authUser = Auth::user();
                $user = User::find($authUser->id);

                if (!$user) {
                    $view->with('unreadNotificationCount', $unreadNotificationCount)
                        ->with('currentPetName', $currentPetName)
                        ->with('currentCoins', $currentCoins);
                    return;
                }

                $currentPetName = $user->pet?->nickname;
                $currentCoins = (int) ($user->coins ?? 0);

                if (Schema::hasTable('reading_logs') && Schema::hasTable('users') && Schema::hasColumn('users', 'coins')) {
                    $totalPagesRead = (int) ReadingLog::where('user_id', $user->id)->sum('pages_read');
                    $currentLevel = intdiv($totalPagesRead * 5, 100) + 1;
                    $minimumCoins = $this->minimumCoinsForLevel($currentLevel);

                    if ($currentCoins < $minimumCoins) {
                        $user->coins = $minimumCoins;
                        $user->save();
                        $currentCoins = $minimumCoins;
                    }

                    if (
                        Schema::hasTable('items')
                        && Schema::hasTable('user_inventory')
                        && Schema::hasColumn('user_inventory', 'quantity')
                        && Schema::hasColumn('users', 'starter_items_granted_at')
                        && $currentLevel >= 1
                    ) {
                        $appleItem = Item::firstOrCreate(
                            ['name' => 'Organic Apple'],
                            ['type' => 'food', 'price' => 45, 'image_path' => 'items/organic_apple.png']
                        );

                        $honeyItem = Item::firstOrCreate(
                            ['name' => 'Sweet Honey'],
                            ['type' => 'food', 'price' => 80, 'image_path' => 'items/sweet_honey.png']
                        );

                        if (is_null($user->starter_items_granted_at)) {
                            UserInventory::create([
                                'user_id' => $user->id,
                                'item_id' => $appleItem->id,
                                'quantity' => 3,
                                'is_equipped' => false,
                            ]);

                            UserInventory::create([
                                'user_id' => $user->id,
                                'item_id' => $honeyItem->id,
                                'quantity' => 2,
                                'is_equipped' => false,
                            ]);

                            $user->starter_items_granted_at = now();
                            $user->save();
                        }

                        $starterAppleQty = (int) UserInventory::where('user_id', $user->id)
                            ->where('item_id', $appleItem->id)
                            ->sum('quantity');

                        $starterHoneyQty = (int) UserInventory::where('user_id', $user->id)
                            ->where('item_id', $honeyItem->id)
                            ->sum('quantity');
                    }
                }

                if (Schema::hasTable('notifications')) {
                    $unreadNotificationCount = UserNotification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            }

            $view->with('unreadNotificationCount', $unreadNotificationCount)
                ->with('currentPetName', $currentPetName)
                ->with('currentCoins', $currentCoins)
                ->with('starterAppleQty', $starterAppleQty)
                ->with('starterHoneyQty', $starterHoneyQty);
        });
    }
}