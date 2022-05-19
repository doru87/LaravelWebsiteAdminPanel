<?php

namespace Database\Factories;

use App\Models\RegattaSeason;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsRegattaSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date1 = $this->faker->dateTimeInInterval('+2 week', '+2 months');
        $date1 = $date1->format("Y-m-d");
        $date2 = $this->faker->dateTimeInInterval('+2 months', '+7 months');
        $date2 = $date2->format("Y-m-d");
        return [
            'regatta_season_id' => RegattaSeason::inRandomOrder()->first()->id,
            'inceput_sezon' => $date1,
            'final_sezon' => $date2,
            'imagini' => array($this->faker->imageUrl(640, 480, 'regatta', true), $this->faker->imageUrl(640, 480, 'regatta', true),$this->faker->imageUrl(640, 480, 'regatta', true),$this->faker->imageUrl(640, 480, 'regatta', true),$this->faker->imageUrl(640, 480, 'regatta', true)),
        ];
    }
}
