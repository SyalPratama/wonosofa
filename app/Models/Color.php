<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'hex_code',
    ];

    /**
     * Semua produk yang memiliki warna ini (many-to-many via product_color).
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_color')
            ->withPivot('id', 'stock')
            ->withTimestamps();
    }
}