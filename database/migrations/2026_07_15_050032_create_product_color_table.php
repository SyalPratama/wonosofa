<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_color', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignUuid('color_id')
                ->constrained('colors')
                ->cascadeOnDelete();

            $table->unsignedInteger('stock')->default(0); // stok per kombinasi produk+warna

            $table->timestamps();

            $table->unique(['product_id', 'color_id']); // cegah duplikat kombinasi
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_color');
    }
};