<?php
// 2026_02_28_000004_create_product_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // image, datasheet, certificate, manual, guide, install_video, ond, other
            $table->string('type');

            // store a relative path or storage path; build URL in app (Storage::url)
            $table->string('path');

            // optional display name for downloads center
            $table->string('title')->nullable();

            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();

            $table->unsignedInteger('sort_order')->nullable();
            $table->boolean('is_primary')->default(false);

            $table->string('status')->nullable();
            $table->timestamps();

            $table->index(['product_id']);
            $table->index(['product_id', 'type']);
            $table->index(['product_id', 'type', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_files');
    }
};
