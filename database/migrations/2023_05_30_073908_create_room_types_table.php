<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 255);
            $table->string('name', 255);
            $table->smallInteger('people_quantity', false, true);
            $table->string('bed_type', 255);
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->enum('delete_flag', ['0','1'])->default('0');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_types');
    }
}
