<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_name'); // Snapshot nama produk
            $table->string('strength')->nullable();
            $table->string('size')->nullable();
            $table->string('shot')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Harga dasar produk
            $table->decimal('extra_price', 10, 2)->default(0); // Extra dari varian
            $table->decimal('subtotal', 10, 2); // Total per item
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
