<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id', 'blood_types', 'units_required' , 'highest_need'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
