<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TourPrice;

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
        'payment_id_two',
        'capture_id',
        'capture_id_two',
        'status',
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function price()
    {
        return $this->belongsTo(TourPrice::class, 'tour_date_id'); // price table ka id
    }
}
