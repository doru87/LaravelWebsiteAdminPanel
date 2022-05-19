<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomEventFactory extends Factory
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
            'destinatie' => $this->faker->name,
            'descriere' => $this->faker->sentence,
            'imagine' => $this->faker->imageUrl(640, 480, 'event', true),
        ];
    }
}
