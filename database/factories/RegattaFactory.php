<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegattaFactory extends Factory
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
            'pret' => $this->faker->numberBetween(1000, 10000),
            'imagine' => $this->faker->imageUrl(640, 480, 'regatta', true),
        ];
    }
}
