<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoatFactory extends Factory
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
            'model' => $this->faker->name,
            'an_fabricatie' => $this->faker->numberBetween(2010, 2022),
            'capacitate' => $this->faker->numberBetween(2, 15),
            'layout' => $this->faker->numberBetween(1, 5),
            'imagine' => $this->faker->imageUrl(640, 480, 'boat', true),
        ];
    }
}
