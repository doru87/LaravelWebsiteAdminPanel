<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Boat extends Model
{
    use HasFactory;
    use HasSlug;

    public function details()
    {
        return $this->hasOne(DetailsBoat::class, 'boat_id', 'id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
