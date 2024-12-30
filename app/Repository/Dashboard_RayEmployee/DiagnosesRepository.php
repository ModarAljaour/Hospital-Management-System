<?php

namespace App\Repository\Dashboard_RayEmployee;

use App\Interfaces\Dashboard_RayEmployee\DiagnosesRepositoryInterface;
use App\Models\Ray;
use App\Traits\UploadTrait;


class DiagnosesRepository implements DiagnosesRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $invoices = Ray::where('case', 0)->get();
        return view('Dashboard.Dashboard_RayEmployee.diagnoses.index', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->employee_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.doctor.invoices.view_rays', compact('rays'));
    }

  

    public function completed()
    {
        $invoices = Ray::where('case', 1)->where('employee_id', auth()->user()->id)->get();

        return view('Dashboard.Dashboard_RayEmployee.diagnoses.completed_invoices', compact('invoices'));
    }

    public function store($request)
    {
        //
    }

    public function edit($id)
    {
        $invoice =  Ray::findOrFail($id);
        return view('Dashboard.Dashboard_RayEmployee.diagnoses.add_diagnosis', compact('invoice'));
    }


    public function update($request, $id)
    {
        try {
            $ray = Ray::findOrFail($id);
            $ray->employee_id = auth()->user()->id;
            $ray->description_employee = $request->description_employee;
            // update case :
            $ray->case = 1;

            // upload many image :
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $this->verifyAndStoreImageForeach($photo, 'Rays', 'public', $ray->id, 'App\Models\Ray');
                }
            }
            $ray->save();
            session()->flash('edit');
            return redirect()->route('invoice.index')->with('success', 'ray updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // try {
        //     RayEmployee::destroy($id);
        //     session()->flash('delete');
        //     return redirect()->back();
        // } catch (\Exception $e) {

        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }
}
