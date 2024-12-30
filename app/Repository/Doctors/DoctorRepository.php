<?php

namespace App\Repository\Doctors;

use App\Http\Controllers\Dashboard\DoctorController;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Models\Time;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::with('appointments')->orderby('id', 'desc')->get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        try {
            $sections = Section::all();
            $appointments = Time::all();
            return view('Dashboard.Doctors.add', compact('sections', 'appointments'));
        } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $doctorData = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'number_of_statements' => $request->number_of_statements,
                'status' => 1,
                'name' => $request->name,
            ];



            $doctor = Doctor::create($doctorData);

            // Associate appointments with the doctor
            if ($request->has('appointments')) {
                $doctor->appointments()->sync($request->appointments);
            }

            // Upload image
            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'public', $doctor->id, 'App\Models\Doctor');

            DB::commit();

            session()->flash('add');
            return redirect()->route('doctor.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->fill($request->only(['email', 'section_id', 'phone' , 'number_of_statements']));
            // translate name
            $doctor->name = $request->name;
            $doctor->save();

            // Update appointments
            if ($request->filled('appointments')) {
                $doctor->appointments()->sync($request->appointments);
            } else {
                // If no appointments are selected, detach all existing appointments
                $doctor->appointments()->detach();
            }

            // Update photo if provided
            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($doctor->image) {
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('public', 'doctors/' . $old_img, $id);
                }
                // Upload new img
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'public', $id, 'App\Models\Doctor');
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request)
    {
        if ($request->page_id == 1) {

            if ($request->filename) {

                $this->Delete_attachment('public', 'doctors/' . $request->filename, $request->id, $request->filename);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('doctor.index');
        }
        //---------------------------------------------------------------
        else {

            // delete selector doctor
            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_doctors) {
                $doctor = Doctor::findOrFail($ids_doctors);
                if ($doctor->image) {
                    $this->Delete_attachment('public', 'doctors/' . $doctor->image->filename, $ids_doctors, $doctor->image->filename);
                }
            }
            Doctor::destroy($delete_select_id);
            session()->flash('delete');
            return redirect()->route('doctor.index');
        }
    }

    public function edit($id)
    {
        $sections = Section::all();
        $appointments = Time::all();
        $doctor = Doctor::findOrFail($id);
        return view('Dashboard.Doctors.edit', compact('doctor', 'sections', 'appointments'));
    }

    public function update_password($request)
    {
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->update([
                'status' => $request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
