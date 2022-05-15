<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarUser>
 */
class CarUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'   => $this->faker->unique()->name,
            'car_id' => $this->faker->unique()->numberBetween(1, 22)
        ];
    }
}
