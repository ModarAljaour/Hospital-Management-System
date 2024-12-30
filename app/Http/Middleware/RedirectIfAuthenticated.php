<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        // dd($request->session());
        // dd(Auth::guard($guards[0])->check());
        foreach ($guards as $guard) {
            if (auth('admin')->check()) {
                return redirect(RouteServiceProvider::ADMIN);
            }
            if (auth('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
            if (auth('doctor')->check()) {
                return redirect(RouteServiceProvider::DOCTOR);
            }
            if (auth('ray_employee')->check()) {
                return redirect(RouteServiceProvider::RAYEMPLOYEE);
            }
            if (auth('laboratory_employee')->check()) {
                return redirect(RouteServiceProvider::LABORATORYEMPLOYEE);
            }

            if (auth('patient')->check()) {
                return redirect(RouteServiceProvider::PATIENT);
            }
        }
        return $next($request);
    }
}
