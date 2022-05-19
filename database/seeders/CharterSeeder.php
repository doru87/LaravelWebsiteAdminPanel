<?php

namespace Database\Seeders;

use App\Models\Charter;
use Illuminate\Database\Seeder;

class CharterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Charter::factory()->count(10)->create();
    }
}
