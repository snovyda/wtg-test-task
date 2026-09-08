<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'offer_id',
        'client_reference',
        'customer_name',
        'customer_email',
    ];

    public function offer(): BelongsTo
    {
        $this->belongsTo(Offer::class);
    }
}
