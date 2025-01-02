<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webpatser\Uuid\Uuid;

class Vehicle extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'license_plate',
        'type',
        'ownership',
        'rental_company',
        'fuel_efficiency',
        'next_service_date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
