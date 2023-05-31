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
        Schema::create('order_details', function(Blueprint $table){
           $table->unsignedBigInteger('product_id');
           $table->unsignedBigInteger('order_id');
           $table->foreign('product_id')->references('product_id')->on('products');
           $table->foreign('order_id')->references('order_id')->on('orders');
           $table->integer('quantity');
           $table->integer('unit_price');
           $table->timestamps();
       });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
