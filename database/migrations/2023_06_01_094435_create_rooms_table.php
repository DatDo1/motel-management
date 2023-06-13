<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('uuid', 255);
            $table->smallInteger('floor', false, true);
            $table->enum('is_available', ['0','1']);
            $table->string('image', 255);
            $table->bigInteger('reference_price', false, true);
            $table->integer('area', false, true);
            $table->timestamps();
            $table->softDeletes();
            $table->enum('delete_flag', ['0','1'])->default('0');
            $table->unsignedBigInteger('room_type_id');

            $table->foreign('room_type_id')->references('id')->on('room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
