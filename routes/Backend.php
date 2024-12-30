<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Models\RayEmployee;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::get('/dashboard_admin', [DashboardController::class, 'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setlocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        //.................... {{ user }} ........................................

        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard.user');

        //................... {{ ADMIN }} ........................................

        Route::get('/dashboard/admin', function () {

            return view('Dashboard.Admin.dashboard');
        })
            ->middleware(['auth:admin'])
            ->name('dashboard.admin');

        //......................{{ section }} ...............................

        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('section', SectionController::class);
        });


        //......................{{ Service  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('service', SingleServiceController::class);
        });

        //......................{{ Ambulance  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('ambulance', AmbulanceController::class);
        });

        //......................{{ Insurances  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('insurance', InsuranceController::class);
        });

        //......................{{ Insurances  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('patient', PatientController::class);
        });

        //......................{{ RayEmployee  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('ray_employee', RayEmployeeController::class);
        });

        //......................{{ Receipt  }} .............................
        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('receipt', ReceiptController::class);
        });

        //......................{{ Doctor }} ...............................

        Route::middleware(['auth:admin'])->group(function () {

            Route::resource('doctor', DoctorController::class);

            Route::post('/update_password', [DoctorController::class, 'update_password'])
                ->name('doctor.update_password');

            Route::post('/update_status', [DoctorController::class, 'update_status'])
                ->name('doctor.update_status');
        });


        //......................{{ Appointments  }} ...............................

        Route::middleware(['auth:admin'])->group(function () {

            Route::get('dashboard/admin/appointments',[ \App\Http\Controllers\Dashboard\AppointmentController::class , 'index'])
                ->name('appointment-index');

            Route::put('dashboard/admin/appointments/approval/{id}',[ \App\Http\Controllers\Dashboard\AppointmentController::class , 'approval'])
                ->name('appointment-approval');

            Route::get('dashboard/admin/appointment/certain',[ \App\Http\Controllers\Dashboard\AppointmentController::class , 'certain'])
                ->name('appointment-certain');

            Route::get('dashboard/admin/appointment/done',[ \App\Http\Controllers\Dashboard\AppointmentController::class , 'done'])
                ->name('appointment-done');

            Route::delete('dashboard/admin/appointments/destroy/{id}' , [\App\Http\Controllers\Dashboard\AppointmentController::class , 'destroy'])
                ->name('appointment-destroy');



        });


        Route::middleware(['auth:admin'])->group(function () {



        //......................{{ Livewire }} ...............................
        Route::view('add_group_service', 'livewire.GroupServices.include_create')->name('add_group_service');

        //......................{{ single-invoices }} ...............................

        Route::view('single-invoices', 'livewire.single-invoices.index')->name('single-invoices');
        Route::view('single-invoices/print', 'livewire.single-invoices.print')->name('single-invoices.print');

        //......................{{ Group-invoices }} ...............................
        Route::view('group-invoices', 'livewire.group-invoices.index')->name('group-invoices');
        Route::view('group-invoices/print', 'livewire.group-invoices.print')->name('group-invoices.print');
        });
        // ..........................{{  Laboratory Employee  }}  ..................................
        Route::middleware(['admin'])->group(function () {
            Route::resource('laboratory-employee', LaboratoryEmployeeController::class);
        });

        require __DIR__ . '/auth.php';
    }
);
