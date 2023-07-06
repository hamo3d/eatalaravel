<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SacrificeFollowup extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function donations(){
        return $this->belongsTo(Donation::class,'donation_id');
    }
}
