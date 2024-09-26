<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

class DynamicAdminLteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                // Set dashboard URL based on user role
                if (Auth::user()->role === 'admin') {
                    config(['adminlte.dashboard_url' => 'dashboard']);
                } elseif (Auth::user()->role === 'student') {
                    config(['adminlte.dashboard_url' => 'student/dashboard']);
                }
            }
        });
    }
}
