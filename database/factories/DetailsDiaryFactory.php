<?php

namespace Database\Factories;

use App\Models\Diary;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailsDiaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diary_id' => Diary::inRandomOrder()->first()->id,
            'descriere_detaliata' => $this->faker->sentence,
            'imagini' => array($this->faker->imageUrl(640, 480, 'diary', true), $this->faker->imageUrl(640, 480, 'diary', true),$this->faker->imageUrl(640, 480, 'diary', true),$this->faker->imageUrl(640, 480, 'diary', true),$this->faker->imageUrl(640, 480, 'diary', true)),
        ];
    }
}
