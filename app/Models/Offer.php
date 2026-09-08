<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'supplier_id',
        'import_id',
        'external_id',
        'property_id',
        'check_in',
        'check_out',
        'max_guests',
        'price',
        'currency',
        'available_units',
        'expires_at',
    ];

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }

    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }
}
