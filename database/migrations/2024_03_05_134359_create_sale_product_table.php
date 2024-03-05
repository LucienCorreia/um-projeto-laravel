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
        Schema::create('sale_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained(
                table: 'sales',
                indexName: 'sale_id',
            )
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'product_id',
            )
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantity');
            $table->float('price');
            $table->float('total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_product');
    }
};
