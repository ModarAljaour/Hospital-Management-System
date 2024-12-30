<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use App\Models\Laboratorie;
use Illuminate\Http\Request;

class LaboratorieController extends Controller
{
    public function store(Request $request)
    {
        try {
            $ray = new Laboratorie();
            $ray->description = $request->description;
            $ray->invoice_id = $request->invoice_id;
            $ray->patient_id = $request->patient_id;
            $ray->doctor_id = $request->doctor_id;
            $ray->save();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ray = Laboratorie::findOrFail($id);
            $ray->fill($request->only(['invoice_id', 'patient_id', 'doctor_id', 'description']));
            $ray->save();
            session()->flash('edit');
            return redirect()->back()->with('success', 'ray updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Laboratorie::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
