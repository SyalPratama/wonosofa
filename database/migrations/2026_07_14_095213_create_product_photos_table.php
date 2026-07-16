<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->string('file_name');
            $table->boolean('is_primary')->default(false); // dipakai sebagai thumbnail
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['product_id', 'is_primary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_photos');
    }
};