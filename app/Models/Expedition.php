<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Expedition extends Model
{
    use HasFactory;
    use HasSlug;

    public function details()
    {
        return $this->hasOne(DetailsExpedition::class, 'expedition_id', 'id');
    }

    public function itineraries()
    {
        return $this->hasMany(ExpeditionItinerary::class, 'expedition_id', 'id');
    }

    public function image()
    {
        return (empty($this->imagine)) ? true : false;
    }
    public function images()
    {
        return (empty($this->imagini)) ? true : false;
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
