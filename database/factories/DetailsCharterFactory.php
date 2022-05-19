<?php

namespace Database\Factories;

use App\Models\Charter;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsCharterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'charter_id' => Charter::inRandomOrder()->first()->id,
            'imagini' => array($this->faker->imageUrl(640, 480, 'charter', true), $this->faker->imageUrl(640, 480, 'charter', true),$this->faker->imageUrl(640, 480, 'charter', true),$this->faker->imageUrl(640, 480, 'charter', true),$this->faker->imageUrl(640, 480, 'charter', true)),
            'servicii_incluse' => $this->faker->paragraph(),
            'check_in' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'check_out' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
        ];
    }
}
