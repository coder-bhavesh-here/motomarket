<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

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
        'bike_insurance',
        'insurance_notes',
    ];
    protected $appends = ['is_favourite'];
    public function getIsFavouriteAttribute()
    {
        return $this->favourites()->where('user_id', Auth::id())->exists();
    }

    public const BIKE_INCLUDED = 'Bike included';
    public const BRING_OWN_BIKE = 'Bring own bike';
    public const BIKE_RENTAL = 'Bike rental';
    public const BEGINNER = 'Beginner';
    public const INTERMEDIATE = 'Intermediate';
    public const EXPERT = 'Expert';
    public const INCLUDED_IN_PRICE = 'included_in_price';
    public const ADDON_OR_ANOTHER_SUPPLIER = 'addon_or_another_supplier';
    public const MUST_PURCHASE = 'must_purchase';
    public const NOT_REQUIRED = 'not_required';

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

    public function favourites()
    {
        return $this->hasMany(FavouriteTour::class, 'tour_id');
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
