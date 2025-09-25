<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe\Price;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id',
        'tour_date_id',
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
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function price()
    {
        return $this->belongsTo(Price::class, 'tour_date_id'); // price table ka id
    }
}
