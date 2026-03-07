<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['grandchild_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('grandchild_id')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('grandchild_id')
                ->references('id')
                ->on('grandchilds')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['grandchild_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('grandchild_id')->nullable(false)->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('grandchild_id')
                ->references('id')
                ->on('grandchilds')
                ->restrictOnDelete();
        });
    }
};
