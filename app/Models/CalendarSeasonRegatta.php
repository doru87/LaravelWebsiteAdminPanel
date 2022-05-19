<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CalendarSeasonRegatta extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = ['regatta_season_id'];

    public function regatta()
    {
        return $this->belongsTo(RegattaSeason::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
