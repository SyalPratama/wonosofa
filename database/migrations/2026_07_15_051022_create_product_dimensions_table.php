<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_dimensions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')
                ->unique() // satu produk hanya punya satu baris dimensi
                ->constrained('products')
                ->cascadeOnDelete();

            $table->string('general_dimensions')->nullable();  // contoh: "84\"W x 36\"D x 32\"H"
            $table->string('seat_height')->nullable();          // contoh: "18\""
            $table->string('seat_depth')->nullable();           // contoh: "22\""
            $table->string('arm_height')->nullable();           // contoh: "24\""
            $table->decimal('total_weight_lbs', 8, 2)->nullable();
            $table->string('box_dimensions')->nullable();       // contoh: "88\"L x 38\"W x 30\"H"

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_dimensions');
    }
};