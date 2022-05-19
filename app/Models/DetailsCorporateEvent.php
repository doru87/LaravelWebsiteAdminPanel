<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCorporateEvent extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array'
    ];

    public function corporate()
    {
        return $this->belongsTo(CorporateEvent::class, 'corporate_event_id', 'id');
    }
}
