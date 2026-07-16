<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPhoto extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'file_name',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Produk pemilik foto ini.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * URL publik foto ini. `file_name` diisi path relatif dari folder /public,
     * contoh: "assets/img/products/sofa-chester-beige-1.jpg"
     * atau: "assets/img/home/sofa_white.webp"
     */
    public function getUrlAttribute(): string
    {
        return asset(ltrim($this->file_name, '/'));
    }

    /**
     * Pastikan hanya ada SATU foto primary per produk.
     * Kalau foto ini ditandai primary, foto lain di produk yang sama otomatis di-nonaktifkan.
     */
    protected static function booted(): void
    {
        static::saving(function (ProductPhoto $photo) {
            if ($photo->is_primary) {
                static::where('product_id', $photo->product_id)
                    ->when($photo->exists, fn ($query) => $query->whereKeyNot($photo->id))
                    ->update(['is_primary' => false]);
            }
        });
    }
}