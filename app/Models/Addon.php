<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = ['addon_group_id', 'name', 'price', 'image_path'];

    public function group()
    {
        return $this->belongsTo(AddonGroup::class, 'addon_group_id');
    }
}
