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
            $table->string('slug');
            $table->json('category_id')->nullable();
            $table->string('type')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('brand_id')->nullable();
            $table->json('attribute')->nullable();
            $table->json('colors')->nullable();
            $table->json('variation')->nullable();
            $table->json('choice_options')->nullable();
            $table->integer('home_status')->nullable();
            $table->text('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
