<?php

namespace App\Repository\Dashboard_laboratory;

use App\Interfaces\Dashboard_Laboratory\LaboratoryRepositoryInterface;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Traits\UploadTrait;


class LaboratoryRepository implements LaboratoryRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $invoices = Laboratorie::where('case', 0)->get();
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $laboratorie = Laboratorie::findOrFail($id);
        if ($laboratorie->employee_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.patient_details', compact('laboratorie'));
    }

    public function completed()
    {
        $invoices = Laboratorie::where('case', 1)->where('employee_id', auth()->user()->id)->get();

        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.completed_invoices', compact('invoices'));
    }


    public function edit($id)
    {
        $invoice =  Laboratorie::findOrFail($id);
        return view('Dashboard.dashboard_LaboratorieEmployee.invoices.add_diagnosis', compact('invoice'));
    }


    public function update($request, $id)
    {

        try {
            $Laboratorie = Laboratorie::findOrFail($id);
            $Laboratorie->employee_id = auth()->user()->id;
            $Laboratorie->description_employee = $request->description_employee;
            // update case :
            $Laboratorie->case = 1;

            // upload many image :
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $this->verifyAndStoreImageForeach($photo, 'Laboratories', 'public', $Laboratorie->id, 'App\Models\Laboratorie');
                }
            }
            $Laboratorie->save();
            session()->flash('edit');
            return redirect()->route('invoice.index')->with('success', 'Laboratorie updated successfully');
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
