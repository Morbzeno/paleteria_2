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
        Schema::create('admin_payments', function (Blueprint $table) {
            $table->bigIncrements('admin_payment__id')->nullable(false);
            $table->foreignId('admin_id')->nullable(false);

            $table->decimal('pay', total: 8, places: 2)->nullable(false);
            $table->date('payment_date')->nullable(false);
            $table->date('next_payment')->nullable(false);
               
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')->references('admin_id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_payments');
    }
};
