<?php

namespace Database\Seeders;

use App\Models\DetailsBoat;
use Illuminate\Database\Seeder;

class DetailsBoatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailsBoat::factory()->count(10)->create();
    }
}
