<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'price',
        'date',
        'end_date',
        'duration_days',
        'rest_days',
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
