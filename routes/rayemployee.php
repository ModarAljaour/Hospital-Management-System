<?php

use App\Http\Controllers\Dashboard_Ray_Employee\DiagnosesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setlocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        //................... {{ Dashboard Ray Employee }} ........................................

        Route::get('/dashboard/ray-employee', function () {
            return view('Dashboard.Dashboard_RayEmployee.dashboard');
        })
            ->middleware(['auth:ray_employee'])
            ->name('dashboard.ray_employee');

        //......................{{ ray_employee }} ...............................

        Route::middleware(['auth:ray_employee'])->group(function () {

            // Invoice route
            Route::resource('/dashboard/ray-employee/invoice', DiagnosesController::class);
            Route::get('/dashboard/ray-employee/invoice-complete', [DiagnosesController::class, 'completed'])->name('completed_invoices');
            Route::get("/dashboard/ray-employee/view_rays/{id}" , [DiagnosesController::class , 'show'])->name('view_rays');
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name("404");


        });
//


        require __DIR__ . '/auth.php';
    }
);
