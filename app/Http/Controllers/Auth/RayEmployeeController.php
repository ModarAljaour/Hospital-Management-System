<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RayEmployeeRequest;
use App\Models\RayEmployee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeController extends Controller
{
    public function store(RayEmployeeRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::RAYEMPLOYEE);
    }

    public function destroy(Request $request)
    {
        Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
