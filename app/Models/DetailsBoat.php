<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBoat extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array'
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id', 'id');
    }
    
}
