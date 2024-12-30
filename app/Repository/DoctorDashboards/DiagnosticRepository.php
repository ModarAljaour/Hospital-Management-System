<?php

namespace App\Repository\DoctorDashboards;

use App\Interfaces\DoctorDashboards\DiagnosticRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DiagnosticRepository implements DiagnosticRepositoryInterface
{
    public function store($request)
    {
        // process tow query
        DB::beginTransaction();
        try {

            // create method for update and call in here
            // number 3 to update status to be completed
            $this->invoice_status($request->invoice_id, 3);

            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function invoice_status($invoice_id,  $status)
    {
        $invoice_status = Invoice::findOrFail($invoice_id);
        $invoice_status->update([
            'invoice_status' => $status,
        ]);
    }

    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        return view('Dashboard.doctor.invoices.patient_record', compact('patient_records'));
    }

    public function addReview($request)
    {
        // process tow query
        DB::beginTransaction();
        try {
            $this->invoice_status($request->invoice_id, 2);

            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
