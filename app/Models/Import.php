<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Import extends Model
{
    protected $table = 'imports';

    protected $fillable = [
        'supplier_id',
        'external_import_id',
        'sent_at',
        'status',
        'total_offers',
        'processed_offers',
        'error',
        'completed_at',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }
}
