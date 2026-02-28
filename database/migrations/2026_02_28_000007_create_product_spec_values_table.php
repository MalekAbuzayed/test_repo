<?php
// 2026_02_28_000007_create_product_spec_values_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_spec_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('spec_field_id')
                ->constrained('spec_fields')
                ->cascadeOnDelete();

            // store display value (can be "40-60", ">96%", "3.96 (7.04 for 10s)")
            $table->text('value_text');

            $table->timestamps();

            // one value per product per field
            $table->unique(['product_id', 'spec_field_id']);

            $table->index('spec_field_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_spec_values');
    }
};
