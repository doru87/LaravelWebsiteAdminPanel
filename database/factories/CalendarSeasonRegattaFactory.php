<?php

namespace Database\Factories;

use App\Models\Regatta;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarSeasonRegattaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $regatta = Regatta::inRandomOrder()->first();
        return [
            'regatta_id' => $regatta->id, //
            'nume' => $regatta->nume,
            'perioada' => strval($this->faker->numberBetween(2, 14)) . " zile",
            'locatie' => $this->faker->city,
        ];
    }
}
