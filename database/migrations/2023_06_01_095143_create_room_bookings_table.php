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
            $table->date('checkin_date')->primary();
            $table->unsignedBigInteger('booking_id')->primary();
            $table->unsignedBigInteger('room_id')->primary();
            $table->date('checkout_date');
            $table->unsignedBigInteger('pay_price');
            $table->timestamps();
            $table->softDeletes();
            $table->enum('delete_flag', ['0','1'])->default('0');
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
