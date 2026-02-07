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
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('inventory_id')->nullable(false);
            $table->foreignId('ingredient_id')->nullable(false);

            $table->integer('stock')->nullable(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ingredient_id')->references('ingredient_id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
