<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $unreadNotificationCount = 0;

            if (Auth::check() && Auth::user()->role === 'user') {
                $unreadNotificationCount = Notification::where(
                    'user_id',
                    Auth::id()
                )
                    ->where('status', 'unread')
                    ->count();
            }

            $view->with(
                'unreadNotificationCount',
                $unreadNotificationCount
            );
        });
    }
}