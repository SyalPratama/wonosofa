<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductShippingAndReturn extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product_shipping_and_return';

    protected $fillable = [
        'product_id',
        'shipping_info',
        'return_policy',
    ];

    /**
     * Produk pemilik data shipping & return ini.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}