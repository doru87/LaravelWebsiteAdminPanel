<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Regatta extends Model
{
    use HasFactory;
    use HasSlug;

    public function details()
    {
        return $this->hasOne(DetailsRegatta::class, 'regatta_id', 'id');
    }

    // public function image()
    // {
    //     return (empty($this->imagine)) ? true : false;
    // }
    // public function images()
    // {
    //     return (empty($this->imagini)) ? true : false;
    // }
    // public function calendar()
    // {
    //     return $this->belongsTo(CalendarSeasonRegatta::class);
    // }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
