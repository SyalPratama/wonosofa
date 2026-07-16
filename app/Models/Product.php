<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'material',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Otomatis membuat slug dari name kalau belum diisi.
     */
    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Semua warna yang tersedia untuk produk ini (many-to-many via product_color).
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_color')
            ->withPivot('id', 'stock')
            ->withTimestamps();
    }

    /**
     * Semua foto produk ini.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class)->orderBy('sort_order');
    }

    /**
     * Satu foto yang ditandai sebagai primary (dipakai untuk thumbnail).
     */
    public function primaryPhoto(): HasOne
    {
        return $this->hasOne(ProductPhoto::class)->where('is_primary', true);
    }

    /**
     * Data dimensi produk (general dimensions, seat height, dll).
     */
    public function dimension(): HasOne
    {
        return $this->hasOne(ProductDimension::class);
    }

    /**
     * Data shipping & return produk ini.
     */
    public function shippingAndReturn(): HasOne
    {
        return $this->hasOne(ProductShippingAndReturn::class);
    }

    /**
     * Accessor cepat untuk thumbnail: pakai foto primary,
     * kalau belum ada fallback ke foto pertama.
     */
    public function getThumbnailAttribute(): ?string
    {
        $photo = $this->primaryPhoto ?? $this->photos->first();

        return $photo?->url;
    }
}