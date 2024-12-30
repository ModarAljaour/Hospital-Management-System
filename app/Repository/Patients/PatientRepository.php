<?php

namespace App\Repository\Patients;

use App\Events\MyEvent;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\GroupInvoice;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\SingleInvoice;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{

    public function index()
    {
        $Patients = Patient::all();

        return view('Dashboard.Patients.index', compact('Patients'));
    }

    // create Patient
    public function create()
    {
        return view('Dashboard.Patients.create');
    }

    // store Patient
    public function store($request)
    {

        try {
            $Patient = new Patient();
            $Patient->email = $request->email;
            $Patient->password = Hash::make($request->phone);
            $Patient->date_birth = $request->date_birth;
            $Patient->phone = $request->phone;
            $Patient->gender = $request->gender;
            $Patient->blood_group = $request->blood_group;
            $Patient->save();
            // insert trans
            $Patient->name = $request->name;
            $Patient->address = $request->address;
            $Patient->save();

            session()->flash('add');
            return redirect()->route('patient.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show Patients :
    public function show($id)
    {
        $Patient = Patient::findOrFail($id);
        $invoices = Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
        return view(
            'Dashboard.Patients.show',
            compact(['Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'])
        );
    }

    // Edit Patient
    public function edit($id)
    {
        $Patient = Patient::findOrFail($id);
        return view('Dashboard.Patients.edit', compact('Patient'));
    }
    // update Patient
    public function update($request, $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->fill($request->only([
                'email',
                'phone',
                'password',
                'gender',
                'blood_group',
                'date_birth'
            ]));

            $patient->name = $request->name;
            $patient->address = $request->address;
            $patient->save();

            session()->flash('edit');
            return redirect()->route('patient.index')->with('success', 'patient updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // destroy Patient
    public function destroy($id)
    {
        try {
            Patient::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
