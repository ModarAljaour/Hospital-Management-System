<?php

namespace App\Http\Livewire\Appointments;


use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;
use PhpParser\Comment\Doc;

class Create extends Component
{

    public $doctors;
    public $doctor;
    // for select sections from Model
    public $sections;
    // for section input
    public $section;
    public $name;
    public $email;
    public $notes;
    public $phone;
    public $date;
    public $msg = false;
    public $message = false;

    public function mount()
    {
        $this->sections = Section::get();
        $this->doctors = collect();
    }

    public function render()
    {
        return view('livewire.appointments.create' , [
            'sections' => Section::get(),
        ]);
    }

    public function updatedSection($section_id)
    {
        $this->doctors = Doctor::where('section_id' , $section_id)->get();
    }

    public function store(){

        $appointment_count = Appointment::where('doctor_id' , $this->doctor)->where('type' , 'غير مؤكد')->where('date' , $this->date)->count();
        $doctor_limit = Doctor::where('id' , $this->doctor)->value('number_of_statements');
        if ($appointment_count  === (int)$doctor_limit){
            $this->msg = true;
            return back();
        }
        $appointment = new Appointment;
        $appointment->doctor_id = $this->doctor;
        $appointment->section_id = $this->section;
        $appointment->name = $this->name;
        $appointment->email = $this->email;
        $appointment->phone = $this->phone;
        $appointment->date = $this->date;
        $appointment->type = "غير مؤكد";

        $appointment->save();

        $appointment->notes = $this->notes;
        $appointment->save();
        $this->message = true;
    }
}
