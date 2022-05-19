<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsExpedition extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array'
    ];

    public function expedition()
    {
        return $this->belongsTo(Expedition::class, 'expedition_id', 'id');
    }
}
