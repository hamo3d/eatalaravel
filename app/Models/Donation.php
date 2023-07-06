<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];
    

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }


    public function sacrificeFollowup(){
     return $this->hasOne(SacrificeFollowup::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
        
    
        'user_id'
    ];

}
