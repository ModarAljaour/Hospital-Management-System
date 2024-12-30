<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller
{

    public function index($id)
    {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        $patient_rays = Ray::where('patient_id', $id)->get();
        $patient_Laboratories = Laboratorie::where('patient_id', $id)->get();
        return view('Dashboard.doctor.invoices.patient_details', compact(['patient_Laboratories', 'patient_records', 'patient_rays']));
    }

    public function show($id)
    {
        $laboratories = Laboratorie::findOrFail($id);
        if ($laboratories->doctor_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.doctor.invoices.view_laboratories', compact('laboratories'));
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
