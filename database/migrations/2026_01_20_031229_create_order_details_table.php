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
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('order_details_id')->nullable(false);
            $table->foreignId('ingredient_id')->nullable(false);
            $table->foreignId('order_id')->nullable(false);

            $table->integer('quantity')->nullable(false);
            $table->decimal('price', total: 8, places: 2)->nullable(false);  

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('ingredient_id')->references('ingredient_id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
