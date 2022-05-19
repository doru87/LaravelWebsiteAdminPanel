<?php

namespace Database\Seeders;

use App\Models\Boat;
use App\Models\CalendarRegatta;
use App\Models\CalendarSeasonRegatta;
use App\Models\Charter;
use App\Models\CorporateEvent;
use App\Models\CustomEvent;
use App\Models\DetailsBoat;
use App\Models\DetailsCharter;
use App\Models\DetailsCorporateEvent;
use App\Models\DetailsCustomEvent;
use App\Models\DetailsDiary;
use App\Models\DetailsExpedition;
use App\Models\DetailsRegatta;
use App\Models\DetailsRegattaSeason;
use App\Models\Diary;
use App\Models\Expedition;
use App\Models\Regatta;
use App\Models\RegattaSeason;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Boat::factory()->count(10)->has(DetailsBoat::factory()->count(1), 'details')->create();
        // Charter::factory()->count(10)->has(DetailsCharter::factory()->count(1), 'details')->create();
        // Expedition::factory()->count(10)->has(DetailsExpedition::factory()->count(1), 'details')->create();
        // RegattaSeason::factory()->count(10)->has(DetailsRegattaSeason::factory()->count(1), 'details')->create();
        // Regatta::factory()->count(10)->has(DetailsRegatta::factory()->count(1), 'details')->create();
        // CalendarSeasonRegatta::factory()->count(10)->create();
        // CorporateEvent::factory()->count(10)->has(DetailsCorporateEvent::factory()->count(1), 'details')->create();
        // CustomEvent::factory()->count(10)->has(DetailsCustomEvent::factory()->count(1), 'details')->create();
        // Diary::factory()->count(10)->has(DetailsDiary::factory()->count(1), 'details')->create();
    }
}
