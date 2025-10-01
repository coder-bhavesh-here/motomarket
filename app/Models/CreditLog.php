<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'booking_id',
        'amount',
        'currency',
        'type',
        'notes',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
