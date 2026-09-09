<?php

namespace App\Models;

use App\Enums\OfferReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'reservation_status',
    ];

    protected $casts = [
        'price' => 'float',
        'expires_at' => 'datetime:Y-m-d\TH:i:s\Z',
        'status' => OfferReservationStatus::class,
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }

    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }
}
