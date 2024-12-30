<?php

namespace App\Repository\LaboratoryEmployee;

use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\Laboratorie;
use App\Models\Laboratorie_employee;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface
{
    public function index()
    {
        $laboratorie_employees = Laboratorie_employee::all();
        return view('Dashboard.laboratorie_employee.index', compact('laboratorie_employees'));
    }

    public function store($request)
    {
        try {
            $diagnosis = new Laboratorie_employee();
            $diagnosis->name = $request->name;
            $diagnosis->email = $request->email;
            $diagnosis->password = Hash::make($request->password);
            $diagnosis->save();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, ['password']);
            }
            $ray_employee = Laboratorie_employee::findOrFail($id);
            $ray_employee->update($input);
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Laboratorie_employee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
