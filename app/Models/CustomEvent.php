<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CustomEvent extends Model
{
    use HasFactory;
    use HasSlug;

    public function details()
    {
        return $this->hasOne(DetailsCustomEvent::class, 'custom_event_id', 'id');
    }
    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
