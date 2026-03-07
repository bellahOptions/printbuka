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

            $table->string('product_name');

            $table->foreignId('product_category_id')
      ->constrained('product_categories')
      ->cascadeOnDelete();

            $table->text('description');
            $table->string('short_description');
            $table->string('slug')->unique();

            $table->enum('print_type', ['dtf', 'uv-dtf']);

            $table->json('sizes')->nullable();
            $table->json('available_colors')->nullable();

            $table->integer('moq')->default(100);

            $table->enum('visibility', ['visible', 'hidden'])->default('visible');

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
