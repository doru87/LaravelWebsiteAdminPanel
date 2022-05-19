<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CalendarRegatta extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = ['regatta_id'];

    // public function regatta()
    // {
    //     return $this->belongsTo(Regatta::class);
    // }
    public function regatta()
    {
        return $this->hasOne(Regatta::class, 'calendar_regatta_id', 'id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume')
            ->saveSlugsTo('slug');
    }
}
