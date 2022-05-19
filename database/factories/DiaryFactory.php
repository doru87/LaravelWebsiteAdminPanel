<?php

namespace Database\Factories;

use App\Models\CustomEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'custom_event_id' => CustomEvent::inRandomOrder()->first()->id,
            'nume_eveniment' => CustomEvent::inRandomOrder()->first()->nume,
            'descriere_sumara' => $this->faker->sentence,
            'perioada' => strval($this->faker->numberBetween(2, 14)) . " zile",
            'inceput_perioada' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'final_perioada' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'itinerariu' => $this->faker->sentence,
            'imagine' => $this->faker->imageUrl(640, 480, 'diary', true),
        ];
    }
}
