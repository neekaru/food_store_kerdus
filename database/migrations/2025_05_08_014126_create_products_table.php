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
        // Check if the products table already exists
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->string('image');
                $table->string('title')->nullable();
                $table->string('slug');
                $table->text('description');
                $table->integer('price');
                $table->integer('weight')->default(0);
                $table->timestamps();

                // Add foreign key constraint if categories table exists
                if (Schema::hasTable('categories')) {
                    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
