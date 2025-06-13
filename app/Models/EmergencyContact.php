<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emergency_contact_1_name',
        'emergency_contact_1_phone',
        'emergency_contact_1_email',
        'emergency_contact_2_name',
        'emergency_contact_2_phone',
        'emergency_contact_2_email',
        'emergency_contact_3_name',
        'emergency_contact_3_phone',
        'emergency_contact_3_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
