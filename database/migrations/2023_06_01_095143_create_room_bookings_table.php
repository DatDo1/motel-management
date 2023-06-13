<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->date('checkin_date');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id');
            $table->string('uuid', 255);
            $table->date('checkout_date');
            $table->unsignedBigInteger('pay_price');
            $table->timestamps();
            $table->softDeletes();
            $table->enum('delete_flag', ['0','1'])->default('0');

            $table->primary(array('checkin_date', 'booking_id', 'room_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_bookings');
    }
}
