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
            $table->bigIncrements('order_id')->nullable(false);
            $table->foreignId('client_id')->nullable(false);

            $table->decimal('total_price', total: 8, places: 2)->nullable(false);
            $table->enum('deliver_status', ['in_wait', 'send', 'delivered'])->default('in_wait') ->index()->nullable(false);
            $table->date('deliver_date')->nullable(false);   

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_orders');
    }
};
