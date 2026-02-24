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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('ingredient_id')->nullable(false);
            $table->foreignId('supplier_id')->nullable(false);

            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->decimal('price', total: 8, places: 2)->nullable(false);  
            

           $table->string('title', 100);
           $table->string('image', 100);
           $table->string('video_path', 100);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
