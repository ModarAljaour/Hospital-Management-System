<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['قسم الهضمية', 'قسم الصدرية', 'قسم الداخلية', 'قسم الأطفال', 'قسم الجراحة', 'قسم العينية', 'قسم الاسعاف', 'قسم العمليات']),
            'description' => $this->faker->paragraph,
        ];
    }
}
