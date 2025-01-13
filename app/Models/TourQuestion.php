<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'question', 'questioned_by', 'answered_by', 'is_answered'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function questionedBy()
    {
        return $this->belongsTo(User::class, 'questioned_by');
    }

    public function answeredBy()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }
}
