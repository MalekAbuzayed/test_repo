<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_visions', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable()->default('lightbulb');
            $table->string('title_ar')->default('رؤيتنا');
            $table->string('title_en')->default('Our Vision');
            $table->text('bold_description_ar')->nullable();
            $table->text('bold_description_en')->nullable();
            $table->text('normal_description_ar')->nullable();
            $table->text('normal_description_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_visions');
    }
};
