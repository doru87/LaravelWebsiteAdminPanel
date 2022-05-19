<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCustomEvent extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array'
    ];

    public function corporate()
    {
        return $this->belongsTo(CustomEvent::class, 'custom_event_id', 'id');
    }
}
