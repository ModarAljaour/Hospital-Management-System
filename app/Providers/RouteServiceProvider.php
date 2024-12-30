<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const ADMIN = '/dashboard/admin';

    public const HOME = '/dashboard/user';

    public const DOCTOR = '/dashboard/doctor';

    public const RAYEMPLOYEE = '/dashboard/ray-employee';

    public const LABORATORYEMPLOYEE = '/dashboard/laboratory';

    public const PATIENT = '/dashboard/patient';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Backend.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/doctor.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/rayemployee.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/laboratoryemployee.php'));

                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/patient.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
