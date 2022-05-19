<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsRegatta extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array',
    ];

    public function regatta()
    {
        return $this->belongsTo(Regatta::class, 'regatta_id', 'id');
    }
}
