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
        Schema::create('frames', function (Blueprint $table) {
            $table->id('frame_id');
            $table->string('name', 50);
            $table->string('description', 255)->default('Tidak Ada Deskripsi');
            $table->integer('stock');
            $table->decimal('price', 15, 4);
            $table->enum('material', ['metal', 'plastics']);
            $table->enum('shape', ['Oval', 'Circle', 'Rectangle', 'Wellington', 'Boston', 'Fox', 'Half']);
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
        Schema::dropIfExists('frames');
    }
};
