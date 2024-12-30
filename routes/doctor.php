<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Models\Diagnostic;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setlocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        //................... {{ Dashboard Doctor }} ........................................
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })
            ->middleware(['auth:doctor'])
            ->name('dashboard.doctor');

        //......................{{ Doctor }} ...............................
        Route::middleware(['auth:doctor'])->group(function () {

            Route::post('add-review', [DiagnosticController::class, 'addReview'])->name('addReview');
            // Diagnostic route
            Route::resource('diagnostics', DiagnosticController::class);


            // ........................  {{ Laboratories Route }}  ........................................
            // Laboratorie route
            Route::resource('Laboratories', LaboratorieController::class);

            // ......................  {{ Invoices Route }}  ....................

            //review-invoice
            Route::get('review-invoice', [InvoiceController::class, 'reviewinvoice'])->name('reviewinvoice');
            //completed-invoice
            Route::get('completed-invoice', [InvoiceController::class, 'completedinvoice'])->name('completedinvoice');
            // Invoice route
            Route::resource('invoices', InvoiceController::class);

            // ......................  {{ ray Route }}  ....................
            // ray route
            Route::resource('ray', RayController::class);


            // ......................  {{ patient Details Route }}  ....................
            // patient Details route
            Route::get('patient-details/{id}', [PatientDetailsController::class, 'index'])->name('patient-details');
            Route::get('patient-details/laboratory/{id}', [PatientDetailsController::class, 'show'])->name('patient-details-laboratory');


            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name("404");
        });


        require __DIR__ . '/auth.php';
    }
);
