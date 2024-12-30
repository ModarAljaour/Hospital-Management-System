<?php

namespace App\Repository\DoctorDashboards;



use App\Interfaces\DoctorDashboards\InvoiceRepositoryInterface;
use App\Models\Invoice;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 1)->get();
        return view('Dashboard.doctor.invoices.index', compact('invoices'));
    }

    // review Invoice
    public function reviewinvoice()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('Dashboard.doctor.invoices.index', compact('invoices'));
    }

    // completed Invoice
    public function completedinvoice()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('Dashboard.doctor.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->doctor_id != auth()->user()->id){
            return redirect()->route('404');
        }
        return view('Dashboard.doctor.invoices.view_rays', compact('rays'));
    }
}
