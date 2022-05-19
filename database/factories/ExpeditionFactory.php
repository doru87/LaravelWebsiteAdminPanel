<?php

namespace Database\Factories;

use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpeditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nume' => $this->faker->name,
            'descriere' => $this->faker->sentence,
            'model' => Boat::inRandomOrder()->first()->model,
            'perioada' => strval($this->faker->numberBetween(2, 14)) . " zile",
            'skipper' => $this->faker->randomElement(['Inclus', 'Nu e inclus']),
            'pret' => $this->faker->numberBetween(1000, 10000),
            'imagine' => $this->faker->imageUrl(640, 480, 'expedition', true),
        ];
    }
}
