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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transact_id');
            $table->foreign('transact_id')->references('transaction_id')->on('transactions')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            /// Frame Foreign Key
            $table->unsignedBigInteger('frame_id');
            $table->foreign('frame_id')->references('frame_id')->on('frames')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->unsignedInteger('qty');
            $table->unsignedInteger('subtotal');
            ///Lens Foreign Key
            $table->unsignedBigInteger('lens_type_id');
            $table->foreign('lens_type_id')->references('lens_type_id')->on('lens_types')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->enum('eye', ['od', 'os']);
            $table->decimal('sphere', 3, 2)->default(0);
            $table->decimal('cylinder', 3, 2)->default(0);
            $table->string('axis', 5)->comment('the data from front end must be start with x');
            $table->decimal('add', 3, 2)->default(0);
            $table->decimal('prism', 3, 2)->default(0);
            $table->enum('base', ['bu', 'bd', 'bi', 'bo'])->nullable();
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
        Schema::dropIfExists('transaction_details');
    }
};