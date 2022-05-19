<?php

namespace Database\Factories;

use App\Models\CorporateEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsCorporateEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'corporate_event_id' => CorporateEvent::inRandomOrder()->first()->id,
            'imagini' => array($this->faker->imageUrl(640, 480, 'corporate', true), $this->faker->imageUrl(640, 480, 'corporate', true),$this->faker->imageUrl(640, 480, 'corporate', true),$this->faker->imageUrl(640, 480, 'corporate', true),$this->faker->imageUrl(640, 480, 'corporate', true)),
            'servicii_incluse' => $this->faker->paragraph(),
            'servicii_optionale' => $this->faker->paragraph(),
        ];
    }
}
