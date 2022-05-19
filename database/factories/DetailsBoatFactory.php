<?php

namespace Database\Factories;

use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsBoatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'boat_id' => Boat::inRandomOrder()->first()->id,
            'descriere' => $this->faker->sentence,
            'wc_dus' => $this->faker->numberBetween(1, 3),
            'lungime' => $this->faker->numberBetween(5, 15),
            'imagini' => array($this->faker->imageUrl(640, 480, 'boats', true), $this->faker->imageUrl(640, 480, 'boats', true),$this->faker->imageUrl(640, 480, 'boats', true),$this->faker->imageUrl(640, 480, 'boats', true),$this->faker->imageUrl(640, 480, 'boats', true)),
            'dotari_punte_cockpit' => $this->faker->text(400),
            'dotari_bucatarie_salon' => $this->faker->text(400),
            'dotari_cabine' => $this->faker->text(400),
            'echipament_navigatie' => $this->faker->text(200),
            'echipament_siguranta' => $this->faker->text(100),

        ];
    }
}
