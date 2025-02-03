<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id',
        'date',
        'amount',
        'addons',
        'name',
        'dob',
        'nationality',
        'driving_license_number',
        'mobile_number',
        'address',
        'country',
        'postcode',
        'payment_id',
        'status',
    ];
}
