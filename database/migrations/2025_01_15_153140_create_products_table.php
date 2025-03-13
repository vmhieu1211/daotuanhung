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
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->text('description');
            $table->decimal('price', 8, 3);
            $table->bigInteger('quantity');
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->boolean('on_sale')->nullable()->default(0);
            $table->boolean('is_new')->nullable()->default(0);
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
