<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCharter extends Model
{
    use HasFactory;

    protected $casts = [
        'imagini' => 'array'
    ];

    public function charter()
    {
        return $this->belongsTo(Charter::class, 'charter_id', 'id');
    }
}
