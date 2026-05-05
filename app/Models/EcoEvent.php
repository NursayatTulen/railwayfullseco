<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoEvent extends Model
{
    protected $fillable = ['title', 'description', 'event_date'];

    protected $casts = [
        'event_date' => 'date',
    ];
}

