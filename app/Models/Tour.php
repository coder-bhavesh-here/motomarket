<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'riding_style',
        'riding_style_info',
        'rider_capability',
        'rider_capability_info',
        'duration_days',
        'rest_days',
        'max_riders',
        'guides',
        'bike_option',
        'rent_gear',
        'two_up_riding',
        'bike_specification',
        'tour_distance',
        'countries',
    ];

    public const BIKE_INCLUDED = 'Bike included';
    public const BRING_OWN_BIKE = 'Bring own bike';
    public const BIKE_RENTAL = 'Bike rental';
    public const BEGINNER = 'Beginner';
    public const INTERMEDIATE = 'Intermediate';
    public const EXPERT = 'Expert';

    /**
     * Relationship with the TourImage model
     *
     * @param integer $id
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(TourImage::class);
    }

    /**
     * Relationship with the TourImage model
     *
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(TourPrice::class);
    }

    /**
     * Relation with the TourAddOn model
     *
     * @return HasMany
     */
    public function addOns(): HasMany
    {
        return $this->hasMany(TourAddOn::class);
    }

    /**
     * Define the inverse relationship with the User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
