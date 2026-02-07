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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('client_id')->nullable(false);
                
            $table->foreignId('user_id')->nullable(false);
            $table->foreignId('direction_id')->nullable(false);
            $table->foreignId('person_id')->nullable(false);

            $table->enum('client_type', ['normal', 'wholesaler'])->default('normal') ->index()->nullable(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('person_id')->references('person_id')->on('persons');
            $table->foreign('direction_id')->references('direction_id')->on('directions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_clients');
    }
};
