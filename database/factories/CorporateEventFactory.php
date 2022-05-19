<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CorporateEventFactory extends Factory
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
            'tip_activitate' => $this->faker->sentence,
            'durata' => strval($this->faker->numberBetween(2, 14)) . " zile",
            'destinatie' => $this->faker->name,
            'capacitate' =>  strval($this->faker->numberBetween(2, 15)),
            'imagine' => $this->faker->imageUrl(640, 480, 'corporate', true),
        ];
    }
}
