<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourAddOn extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'addon',
        'addon_price',
    ];

    /**
     * Define the inverse relationship with the Tour model
     *
     * @return BelongsTo
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
