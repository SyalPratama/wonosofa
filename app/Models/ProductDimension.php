<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDimension extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'general_dimensions',
        'seat_height',
        'seat_depth',
        'arm_height',
        'total_weight_lbs',
        'box_dimensions',
    ];

    protected $casts = [
        'total_weight_lbs' => 'decimal:2',
    ];

    /**
     * Produk pemilik data dimensi ini.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}