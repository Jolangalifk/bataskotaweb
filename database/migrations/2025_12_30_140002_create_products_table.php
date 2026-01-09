<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('coffee'); // coffee, non-coffee, toast, topping
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            // Variant options
            $table->boolean('has_strength')->default(false); // Normal/Strong
            $table->boolean('has_size')->default(false); // Small/Medium/Large
            $table->boolean('has_shot')->default(false); // 1 Shot/2 Shot/3 Shot
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
