<?php

namespace Database\Factories;

use App\Models\CustomEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsCustomEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'custom_event_id' => CustomEvent::inRandomOrder()->first()->id,
            'imagini' => array($this->faker->imageUrl(640, 480, 'event', true), $this->faker->imageUrl(640, 480, 'event', true),$this->faker->imageUrl(640, 480, 'event', true),$this->faker->imageUrl(640, 480, 'event', true),$this->faker->imageUrl(640, 480, 'event', true)),
        ];
    }
}
