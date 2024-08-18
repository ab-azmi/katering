<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('orderlimit', function (Request $request) {
            return Limit::perMinute(5)
                ->by(optional($request->user())->id ?: $request->ip())
                ->response(function (Request $request, array $headers){
                    return response('Too many request. Tunngu 1 menit lagi', 429, $headers);
                });
        });
    }
}
