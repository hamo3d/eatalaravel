<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_request_id', 'name', 'mobile_number', 'reservation_date'
    ];

    public function bloodDonationRequest()
    {
        return $this->belongsTo(BloodDonationRequest::class);
    }
}
