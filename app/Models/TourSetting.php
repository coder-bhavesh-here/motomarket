<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourSetting extends Model
{
    use HasFactory;
    protected $table = 'tour_settings';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_country',
        'iban',
        'swift',
        'account_number',
        'sort_code',
        'account_name',
    ];

    /**
     * Get the user that owns the tour settings.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
