<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_AGENCY = 'agency';
    const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'tour_currency',
        'bank_name',
        'bank_operating_country',
        'iban',
        'swift_bic',
        'bank_account_number',
        'sort_code',
        'company_showcase_link1',
        'company_showcase_link2',
        'account_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'riding_images' => 'array',
        'tour_riding_images' => 'array',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation with the Tour model
     *
     * @return HasMany
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function favouriteTours(): HasMany
    {
        return $this->hasMany(FavouriteTour::class);
    }
    public function tourSetting(): HasOne
    {
        return $this->hasOne(TourSetting::class);
    }
    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class);
    }
}
