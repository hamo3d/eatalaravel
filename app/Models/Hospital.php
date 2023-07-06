<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'city', 'location'
    ];

    public function bloodDonationRequests()
    {
        return $this->hasMany(BloodRequest::class);
    }
}
