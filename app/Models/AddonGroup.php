<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonGroup extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'name', 'is_required', 'is_multiple'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }
}
