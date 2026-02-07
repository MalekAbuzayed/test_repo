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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('other');
            $table->foreignId('category_id');
            $table->string('subcategory');
            // each type has it's own subcategories and they all share the same specifications 
            // we need a subcategories table || subcategory column but the query might be heavy on performance
            // if we create a table the query will be complex
            // specs are predetermined in the table so products of certain category have certain specs
            // we need specifications table and a column here to point towards it || maybe no column here
            $table->string('title'); // <-------- why this exists alongside with name
            $table->longText('description');
            $table->string('image')->nullable(); // this column might be changed to images and refer to a different table
            $table->string('file')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1: active, 2: inactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /*
                                 id | name | type | subcategory | specs | title | description | image/s | file | status | softDeletes | timestamps
     * 
     */
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
