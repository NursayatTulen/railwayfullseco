<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoProject extends Model
{
    protected $fillable = ['title', 'description'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

