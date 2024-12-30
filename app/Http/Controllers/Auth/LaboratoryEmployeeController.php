<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LaboratoryEmployeeRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratoryEmployeeController extends Controller
{
    public function store(LaboratoryEmployeeRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::LABORATORYEMPLOYEE);
    }

    public function destroy(Request $request)
    {
        Auth::guard('laboratory_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
