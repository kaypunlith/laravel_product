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
        Schema::create('orders', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->bigInteger('userId');
            $table->decimal('amount');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('order_items', function (Blueprint $table) {
           
            $table->increments('id');
            $table->bigInteger('orderId');
            $table->bigInteger('proId');
            $table->tinyInteger('quantity');
            $table->decimal('amount');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('proId')->references('id')->on('products')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
