<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsRegattaSeason extends Model
{
    use HasFactory;
    protected $casts = [
        'imagini' => 'array',
    ];

    public function regattaSeason()
    {
        return $this->belongsTo(RegattaSeason::class, 'regatta_season_id', 'id');
    }
}
