<?php

namespace App\Repository\Insurances;


use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;

class InsuranceRepository  implements InsuranceRepositoryInterface
{

    public function index()
    {
        $insurances = Insurance::all();
        return view('Dashboard.Insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('Dashboard.Insurances.create');
    }

    public function store($request)
    {
        try {
            $insurances = new insurance();
            $insurances->insurance_code = $request->insurance_code;
            $insurances->discount_percentage = $request->discount_percentage;
            $insurances->Company_rate = $request->Company_rate;
            $insurances->status = 1;
            $insurances->save();

            // insert trans
            $insurances->name = $request->name;
            $insurances->notes = $request->notes;

            $i = $insurances->save();
            // dd($i);
            session()->flash('add');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $insurances = Insurance::findOrFail($id);
        return view('Dashboard.Insurances.edit', compact('insurances'));
    }

    public function update($request, $id)
    {

        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $insurance = Insurance::findOrFail($id);

            $insurance->fill($request->only(['insurance_code', 'discount_percentage', 'Company_rate', 'status']));
            $insurance->name = $request->name;
            $insurance->notes = $request->notes;
            $insurance->save();
            session()->flash('edit');
            return redirect()->route('insurance.index')->with('success', 'Insurance updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Insurance::destroy($id);
        session()->flash('delete');
        return redirect()->route('insurance.index');
    }
}
