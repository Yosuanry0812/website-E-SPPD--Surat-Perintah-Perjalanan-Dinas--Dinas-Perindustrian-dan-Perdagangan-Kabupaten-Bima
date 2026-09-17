<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
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
        Carbon::setLocale('id');

        // Paksa skema https hanya saat akses via https (mis. tunnel ngrok),
        // agar asset (CSS/JS) tetap termuat dan localhost http tetap normal.
        if (request()->isSecure()) {
            URL::forceScheme('https');
        }
    }
}
