<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('frame_id');
            $table->foreign('frame_id')->references('frame_id')->on('frames')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->string('pict_path', 100);
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
        Schema::dropIfExists('frame_images');
    }
};
