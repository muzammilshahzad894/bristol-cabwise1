<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'request_type',
        'payment_type',
        'pickup_address',
        'destination_address',
        'pickup_date_time',
        'fleet_id',
        'name',
        'phone',
        'email',
        'no_of_passengers',
        'child_seat',
        'suitcases',
        'hand_luggage',
        'payment_amount',
        'payment_status',
        'booking_status',
        'user_id',
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}