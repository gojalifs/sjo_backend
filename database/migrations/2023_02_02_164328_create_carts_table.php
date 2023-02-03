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

        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
                $table->unsignedBigInteger('frame_id');
            $table->foreign('frame_id')->references('frame_id')->on('frames')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('3');
            $table->unsignedBigInteger('frame_color_id');
            $table->foreign('frame_color_id')->references('id')
                ->on('frame_colors')
                ->restrictOnUpdate()
                ->restrictOnDelete();
                
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
        Schema::dropIfExists('carts');
    }
};