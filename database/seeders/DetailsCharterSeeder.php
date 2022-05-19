<?php

namespace Database\Seeders;

use App\Models\DetailsCharter;
use Illuminate\Database\Seeder;

class DetailsCharterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailsCharter::factory()->count(10)->create();
    }
}
