<?php
// 2026_02_28_000002_create_subcategories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->unique(['category_id', 'name']);
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
