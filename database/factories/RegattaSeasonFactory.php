<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegattaSeasonFactory extends Factory
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
            'nivel_performanta' => $this->faker->name,
            'model' => $this->faker->name,
            'an_fabricatie' => $this->faker->numberBetween(2010, 2022),
            'pret' => $this->faker->numberBetween(1000, 10000),
            'imagine' => $this->faker->imageUrl(640, 480, 'regatta', true),
        ];
    }
}
