<?php
// 2026_02_28_000003_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->restrictOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();

            $table->index(['category_id']);
            $table->index(['subcategory_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
