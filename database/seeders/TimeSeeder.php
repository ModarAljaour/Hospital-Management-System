<?php

namespace Database\Seeders;


use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSeeder extends Seeder
{
    protected $model = Time::class;
    public function run()
    {
        DB::table('times')->delete();
        $appointments = [
            ['name' => 'السبت'],
            ['name' => 'الاحد'],
            ['name' => 'الاثنين'],
            ['name' => 'الثلاثاء'],
            ['name' => 'الاربعاء'],
            ['name' => 'الخميس'],
            ['name' => 'الجمعة'],
        ];
        foreach ($appointments as $appointment) {
            Time::create($appointment);
        }
    }
}
