<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavouriteTour extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'favourite_tours';
    protected $fillable = [
        'tour_id',
        'user_id',
    ];

    /**
     * Get the tour associated with this favorite.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the user who favorited this tour.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
