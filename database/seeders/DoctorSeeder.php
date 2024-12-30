<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            //Doctor::factory()->count(12)->create();
        $doctors = Doctor::factory()->count(12)->create();

        $Appointments = Time::all();
        Doctor::all()->each(function ($doctor) use ($Appointments) {
            $doctor->appointments()->attach(
                $Appointments->random(rand(1, 7))->pluck('id')->toArray()
            );
        });


        // .... OR .....

        // foreach ($doctors as $doctor) {
        //     $Appointments = Appointment::all()->random()->id;
        //     $doctor->appointments()->attach($Appointments);
        // }
    }
}
