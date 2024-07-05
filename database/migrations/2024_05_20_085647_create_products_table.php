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
            $table->id(); // PK
            $table->string('name',255);
            $table->text('description');
            $table->text('image');
            $table->decimal('price',6,2);
            $table->bigInteger('catId')->unsigned();// FK
            $table->foreign('catId')->references('id')->on('categories');
            $table->timestamps();
        });
        //    categories(catId (FK)) -> Products (Id (PK)) (M)
        //    Products -> categories (1)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
