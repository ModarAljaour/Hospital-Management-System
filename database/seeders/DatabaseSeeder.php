<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            TimeSeeder::class,

            SectionSeeder::class,
            DoctorSeeder::class,
            ImageSeeder::class,
            PatientSeeder::class,
            ServiceSeeder::class,
            //  RayEmployeeTableSeeder::class,
        ]);
    }
}
