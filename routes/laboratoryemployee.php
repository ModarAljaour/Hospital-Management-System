<?php

use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Laboratory\LaboratoryController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setlocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        //................... {{ Dashboard laboratory Employee }} ........................................

        Route::get('/dashboard/laboratory', function () {
            return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
        })
            ->middleware(['auth:laboratory_employee'])
            ->name('dashboard.laboratory_employee');

        //......................{{ ray_employee }} ...............................

        Route::middleware(['auth:laboratory_employee'])->group(function () {

            // Invoice route
            Route::resource('/dashboard/laboratory/laboratory', LaboratoryController::class);
            Route::get('/dashboard/laboratory/invoice-complete', [LaboratoryController::class, 'completed'])->name('completed_analysis');
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name("404");
        });



        require __DIR__ . '/auth.php';
    }
);
