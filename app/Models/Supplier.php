<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
    ];

    public function imports(): HasMany
    {
        return $this->hasMany(Import::class);
    }

    public static function findByName(string $name): ?Supplier
    {
        return self::where('name', $name)->first();
    }
}
