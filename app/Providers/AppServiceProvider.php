<?php

namespace App\Providers;

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
        if (
            app()->environment('production') ||
            request()->header('X-Forwarded-Proto') === 'https' ||
            str_contains(request()->getHost(), 'render.com') ||
            str_contains(request()->getHost(), 'onrender.com')
        ) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
