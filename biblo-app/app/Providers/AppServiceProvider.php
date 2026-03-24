<?php

namespace App\Providers;

use App\Models\ReadingLog;
use App\Models\User;
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
                }

                if (Schema::hasTable('notifications')) {
                    $unreadNotificationCount = UserNotification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            }

            $view->with('unreadNotificationCount', $unreadNotificationCount)
                ->with('currentPetName', $currentPetName)
                ->with('currentCoins', $currentCoins);
        });
    }
}