<?php

namespace App\Repository\Dashboard_patient;

use App\Interfaces\Dashboard_patient\PatientRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\PatientAccount;
use App\Models\Ray;
use App\Models\ReceiptAccount;

class PatientRepository implements PatientRepositoryInterface
{
    public function invoice()
    {
        $invoices = Invoice::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.invoices', compact('invoices'));
    }

    public function ray()
    {
        $rays = Ray::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.rays', compact('rays'));
    }

    public function laboratory()
    {
        $laboratories = Laboratorie::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.dashboard_patient.laboratories', compact('laboratories'));
    }
    public function view_ray($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.doctor.invoices.view_rays', compact('rays'));
    }

    public function view_laboratory($id)
    {
        $laboratorie = Laboratorie::findOrFail($id);
        if ($laboratorie->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laboratorie'));
    }

    public function payment(){
        $payments = ReceiptAccount::where("patient_id" , auth()->user()->id)->get();
//        dd($payments);
        return view('Dashboard.dashboard_patient.payments' , compact('payments'));

    }
}
