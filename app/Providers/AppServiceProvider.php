<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Models\User;

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

        Event::listen(Login::class, function ($event) {
            $event->user->update(['is_online' => true]);
        });

        // Saat user logout
        Event::listen(Logout::class, function ($event) {
            $event->user->update(['is_online' => false]);
        });
    }
}
