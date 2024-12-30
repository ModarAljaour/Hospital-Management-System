<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;
    public function definition()
    {
        return [
            'name' =>  $this->faker->randomElement(['تصوير اشعة', 'تبيض اسنان', 'معاينة سريرية ', 'مراجعة', 'فحص طبي', 'فحص عيني']),
            'status' => $this->faker->randomElement(['1', '2']),
            'price' => $this->faker->randomElement(['1000', '2000', '3000', '4500', '5000']),
            'description' => $this->faker->paragraph,
        ];
    }
}
