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
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('person_id')->nullable(false);
                
            $table->string('name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('rfc')->unique()->nullable(false);
            $table->string('phone_number')->unique()->nullable(false);
            $table->string('email_address')->unique()->nullable(false);
               
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
