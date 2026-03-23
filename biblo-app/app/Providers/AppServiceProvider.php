<?php

namespace App\Providers;

use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $unreadNotificationCount = 0;
            $currentPetName = null;

            if (Auth::check()) {
                $user = Auth::user();
                $currentPetName = $user->pet?->nickname;

                if (Schema::hasTable('notifications')) {
                    $unreadNotificationCount = UserNotification::where('user_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }
            }

            $view->with('unreadNotificationCount', $unreadNotificationCount)
                ->with('currentPetName', $currentPetName);
        });
    }
}