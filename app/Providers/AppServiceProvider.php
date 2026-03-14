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
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }

        $this->configureRateLimiting();
    }

    /**
     * Configure named rate limiters used across routes.
     *
     * - login:   5 attempts per minute per IP (brute-force protection)
     * - api:     60 requests per minute per authenticated user or IP (general API)
     */
    protected function configureRateLimiting(): void
    {
        // Brute-force protection for the login endpoint
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->input('email') . '|' . $request->ip())
                ->response(function () {
                    return back()
                        ->withInput()
                        ->withErrors(['email' => 'Demasiadas tentativas. Tente novamente mais tarde.']);
                });
        });

        // Default API limiter
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
