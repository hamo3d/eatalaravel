<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory , HasApiTokens;


    protected $hidden = [
        'created_at',
        'updated_at',
        'email_verified_at',
        'remember_token'
    ];
    public function sacrificeFollowup(){
        return $this->hasMany(SacrificeFollowup::class);
    }

    public function donations(){
        return $this->hasMany(Donation::class);
    }
}
