<?php

use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Laboratory\LaboratoryController;
use App\Http\Controllers\Dashboard_patient\PatientController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setlocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        //................... {{ Dashboard patient }} ........................................

        Route::get('/dashboard/patient', function () {
            return view('Dashboard.dashboard_patient.dashboard');
        })
            ->middleware(['auth:patient'])
            ->name('dashboard.patient');

        //......................{{ patient }} ...............................

        Route::middleware(['auth:patient'])->group(function () {
            // all invoices for patient
            Route::get('/dashboard/patient/invoices', [PatientController::class, 'invoice'])->name('invoice-patient');

            // Rays for patient
            Route::get('/dashboard/patient/rays', [PatientController::class, 'ray'])->name('ray-patient');
            Route::get('/dashboard/patient/laboratory', [PatientController::class, 'laboratory'])->name('laboratory-patient');

            // view the lab. details
            Route::get('/dashboard/patient/laboratory/view/{id}', [PatientController::class, 'view_laboratory'])->name('view-laboratory');

            // view the rays. details
            Route::get('/dashboard/patient/ray/view/{id}', [PatientController::class, 'view_ray'])->name('view-ray');

            // all payment invoice for patient :
            Route::get('/dashboard/patient/payment' , [PatientController::class , 'payment'])->name('payment-patient');

            // validate one patient
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name("404");
        });



        require __DIR__ . '/auth.php';
    }
);
