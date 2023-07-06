<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sacrifice extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];
    
}
