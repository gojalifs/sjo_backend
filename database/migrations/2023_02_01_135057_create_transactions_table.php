<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('address_id')->on('shippings')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->decimal('total', 15, 4)->comment('total price before delivery fee');
            $table->decimal('grand_total', 15, 4)->comment('total after added by delivery fee');
            $table->enum('delivery_status', ['waiting payment', 'pending', 'shipped', 'delivered', 'cancelled'])
                ->default('pending');
            $table->decimal('delivery_fee', 15, 4)->default(0)->comment('default delivery fee is free');
            $table->unsignedBigInteger('payment_info_id');
            $table->foreign('payment_info_id')->references('payment_id')->on('payment_infos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};