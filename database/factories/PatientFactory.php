<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'blood_group' =>  $this->faker->randomElement(['A+', 'O+', 'O-', 'AB', 'A-', 'B+']),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('55555555'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->phoneNumber,
            'date_birth' => $this->faker->date(),

        ];
    }
}
