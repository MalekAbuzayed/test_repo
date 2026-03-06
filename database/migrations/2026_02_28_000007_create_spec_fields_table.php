<?php
// 2026_02_28_000006_create_spec_fields_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spec_fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->cascadeOnDelete();

            $table->foreignId('group_id')
                ->constrained('spec_groups')
                ->cascadeOnDelete();

            // stable machine key, e.g. "max_input_voltage"
            $table->string('key');

            // display label, e.g. "Max Input Voltage (V)"
            $table->string('label');

            $table->string('unit')->nullable(); // V, A, kW, kWh, %
            $table->string('data_type');        // number|text|bool|range

            // yellow fields
            $table->boolean('is_key')->default(false);

            $table->unsignedInteger('sort_order')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();

            $table->unique(['subcategory_id', 'key']);
            $table->index(['group_id', 'sort_order']);
            $table->index(['group_id', 'is_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spec_fields');
    }
};
