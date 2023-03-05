<?php

namespace App\Providers;

use App\Http\Middleware\AdminRoleCheckMiddleware;
use App\Http\Middleware\Localization;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware(['api', 'localization', 'auth:api', 'admin'])
                ->prefix('api/dashboard')
                ->group(base_path('routes/dashboard.php'));

            Route::middleware(['api', 'localization'])
                ->prefix('api/auth')
                ->group(base_path('routes/auth.php'));

            Route::middleware(['api', 'localization'])
                ->prefix('api/')
                ->group(base_path('routes/frontend.php'));

            Route::middleware(['web', 'localization'])
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
