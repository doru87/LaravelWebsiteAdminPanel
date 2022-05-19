<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharterFactory extends Factory
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
            'perioada' => strval($this->faker->numberBetween(2, 14)) . " zile",
            'capacitate' =>  strval($this->faker->numberBetween(2, 15)),
            'skipper' => $this->faker->randomElement(['Inclus', 'Nu e inclus']),
            'pret' => $this->faker->numberBetween(1000, 10000),
            'imagine' => $this->faker->imageUrl(640, 480, 'charter', true),
        ];
    }
}
