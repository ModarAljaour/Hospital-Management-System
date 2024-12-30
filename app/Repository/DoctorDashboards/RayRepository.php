<?php

namespace App\Repository\DoctorDashboards;

use App\Interfaces\DoctorDashboards\RayRepositoryInterface;
use App\Models\Ray;

class RayRepository implements RayRepositoryInterface
{


    public function store($request)
    {
        try {
            $ray = new Ray();
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

    public function update($request, $id)
    {
        try {
            $ray = Ray::findOrFail($id);
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
            Ray::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
