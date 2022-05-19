<?php

namespace Database\Factories;

use App\Models\Expedition;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsExpeditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expedition_id' => Expedition::inRandomOrder()->first()->id,
            'imagini' => array($this->faker->imageUrl(640, 480, 'expedition', true), $this->faker->imageUrl(640, 480, 'expedition', true),$this->faker->imageUrl(640, 480, 'expedition', true),$this->faker->imageUrl(640, 480, 'expedition', true),$this->faker->imageUrl(640, 480, 'expedition', true)),
            'servicii_incluse' => $this->faker->paragraph(),
            'check_in' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'check_out' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
        ];
    }
}
