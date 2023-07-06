<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $appends = ['total_donations'];
    

    public function totalDonations() : Attribute {
        return new Attribute(get: fn() => $this->donations()->sum('amount'));
    }


    public function donations(){
        return $this->hasMany(Donation::class);
    }

    
    public function categories()
    {
        return $this->belongsTo(Category::class, "category_id", 'id');
    }







    protected $fillable = [
        'title',
        'sup_title',
        'required_amount',
        'image',
        'donation_opportunities_id',
        'donation_opportunities_name',
    ];



}
