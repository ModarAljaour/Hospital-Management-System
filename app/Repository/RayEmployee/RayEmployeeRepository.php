<?php

namespace App\Repository\RayEmployee;

use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index', compact('ray_employees'));
    }

    public function store($request)
    {
        try {
            $diagnosis = new RayEmployee();
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
            $ray_employee = RayEmployee::findOrFail($id);
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
            RayEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
