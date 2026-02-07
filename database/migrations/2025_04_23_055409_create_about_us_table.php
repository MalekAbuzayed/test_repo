<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('about_us', function (Blueprint $table) {
        $table->id();
        $table->string('title_ar');
        $table->string('title_en');
        $table->string('subtitle_ar')->nullable(); // <-- جديد
        $table->string('subtitle_en')->nullable(); // <-- جديد
        $table->longText('description_ar');
        $table->longText('description_en');
        $table->text('bold_description_ar')->nullable(); // <-- جديد
        $table->text('bold_description_en')->nullable(); // <-- جديد
        $table->string('icon')->nullable(); // <-- جديد
        $table->longText('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
