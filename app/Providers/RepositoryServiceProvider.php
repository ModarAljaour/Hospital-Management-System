<?php

namespace App\Providers;

use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Dashboard_Laboratory\LaboratoryRepositoryInterface;
use App\Interfaces\Dashboard_patient\PatientRepositoryInterface as Dashboard_patientPatientRepositoryInterface;
use App\Interfaces\Dashboard_RayEmployee\DiagnosesRepositoryInterface;
use App\Interfaces\DoctorDashboards\DiagnosticRepositoryInterface;
use App\Interfaces\DoctorDashboards\InvoiceRepositoryInterface;
use App\Interfaces\DoctorDashboards\RayRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\DoctorsDashboard\InvoicesRepositoryInterface;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Interfaces\Receipts\ReceiptRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\Dashboard_laboratory\LaboratoryRepository;
use App\Repository\Dashboard_patient\PatientRepository as Dashboard_patientPatientRepository;
use App\Repository\Dashboard_RayEmployee\DiagnosesRepository;
use App\Repository\DoctorDashboards\DiagnosticRepository;
use App\Repository\DoctorDashboards\InvoiceRepository;
use App\Repository\DoctorDashboards\RayRepository;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\DoctorsDashboard\InvoicesRepository;
use App\Repository\Insurances\InsuranceRepository;
use App\Repository\LaboratoryEmployee\LaboratoryEmployeeRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\RayEmployee\RayEmployeeRepository;
use App\Repository\Receipts\ReceiptRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Services\SingleServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);

        //Dashboard Doctor
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(DiagnosticRepositoryInterface::class, DiagnosticRepository::class);
        $this->app->bind(RayRepositoryInterface::class, RayRepository::class);

        //in admin -> RayEmployee  ::
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);

        //in admin -> Laboratory Employee  ::
        $this->app->bind(LaboratoryEmployeeRepositoryInterface::class, LaboratoryEmployeeRepository::class);


        //Dashboard of RayEmployee  ::
        $this->app->bind(DiagnosesRepositoryInterface::class, DiagnosesRepository::class);

        //Dashboard of Laboratory  ::
        $this->app->bind(LaboratoryRepositoryInterface::class, LaboratoryRepository::class);


        //Dashboard of patient  ::
        $this->app->bind(Dashboard_patientPatientRepositoryInterface::class, Dashboard_patientPatientRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
