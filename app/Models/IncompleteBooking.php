<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncompleteBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'price_id',
        'user_id',
    ];
}
