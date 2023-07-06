<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function Campaigns()
    {
        return $this->hasMany(Campaign::class, 'category_id', 'id');
    }


    public function advertisements() {
        return $this->hasMany(Advertisements::class);
    }


    

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
    ];

}
