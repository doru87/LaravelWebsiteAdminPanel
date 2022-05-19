<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Diary extends Model
{
    use HasFactory;
    use HasSlug;

    public function details()
    {
        return $this->hasOne(DetailsDiary::class, 'diary_id', 'id');
    }
 
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nume_eveniment')
            ->saveSlugsTo('slug');
    }
}
