<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class RegattaSeason extends Model
{
    use HasFactory;
    use HasSlug;
    
    public function details()
    {
        return $this->hasOne(DetailsRegattaSeason::class, 'regatta_season_id', 'id');
    }

    // public function calendar()
    // {
    //     return $this->hasOne(CalendarRegatta::class, 'regatta_id', 'id');
    // }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
