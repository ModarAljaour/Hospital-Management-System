<?php

namespace App\Repository\Ambulances;

use App\Events\MyEvent;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::all();
        event(new Ambulance());
        return view('Dashboard.Ambulances.index', compact('ambulances'));
    }

    // create Ambulances
    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }

    // store Ambulances
    public function store($request)
    {
        try {
            $ambulance = new Ambulance();
            $ambulance->car_number = $request->car_number;
            $ambulance->car_model = $request->car_model;
            $ambulance->car_year_made = $request->car_year_made;
            $ambulance->driver_license_number = $request->driver_license_number;
            $ambulance->driver_phone = $request->driver_phone;
            $ambulance->car_type = $request->car_type;
            $ambulance->is_available = 1;
            $ambulance->save();

            // insert trans
            $ambulance->driver_name = $request->driver_name;
            $ambulance->notes = $request->notes;

            $ambulance->save();

            //event(new \App\Events\Ambulance($ambulance));

            session()->flash('add');

            return redirect()->route('ambulance.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Edit Ambulances
    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        // dd($ambulance);
        return view('Dashboard.Ambulances.edit', compact('ambulance'));
    }
    // update Ambulances
    public function update($request, $id)
    {
        try {
            if (!$request->has('is_available'))
                $request->request->add(['is_available' => 2]);
            else
                $request->request->add(['is_available' => 1]);

            $ambulance = Ambulance::findOrFail($id);
            $ambulance->fill($request->only([
                'car_number',
                'car_model',
                'car_year_made',
                'car_type',
                'driver_license_number',
                'driver_phone',
                'is_available'
            ]));
            $ambulance->driver_name = $request->driver_name;
            $ambulance->notes = $request->notes;
            $ambulance->save();

            session()->flash('edit');
            return redirect()->route('ambulance.index')->with('success', 'ambulance updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // destroy Ambulances
    public function destroy($id)
    {
        try {
            Ambulance::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
