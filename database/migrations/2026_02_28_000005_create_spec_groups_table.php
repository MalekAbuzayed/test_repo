<?php
// 2026_02_28_000005_create_spec_groups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spec_groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->cascadeOnDelete();

            // e.g. "PV Input Specifications"
            $table->string('title');

            $table->unsignedInteger('sort_order')->nullable();
            $table->timestamps();

            $table->unique(['subcategory_id', 'title']);
            $table->index(['subcategory_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spec_groups');
    }
};
