<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_shipping_and_return', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')
                ->unique() // satu produk hanya punya satu baris shipping & return
                ->constrained('products')
                ->cascadeOnDelete();

            $table->text('shipping_info')->nullable(); // detail pengiriman: estimasi, metode, biaya, dll
            $table->text('return_policy')->nullable(); // kebijakan pengembalian barang

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_shipping_and_return');
    }
};