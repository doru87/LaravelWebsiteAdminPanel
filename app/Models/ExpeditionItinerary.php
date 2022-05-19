<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpeditionItinerary extends Model
{
    use HasFactory;

    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'expedition_id', 'id');
    }
}
