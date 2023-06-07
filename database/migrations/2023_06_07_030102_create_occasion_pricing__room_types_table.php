<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccasionPricingRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occasion_pricing__room_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('real_price');
            $table->timestamps();
            $table->softDeletes();
            $table->enum('delete_flag', ['0','1'])->default('0');
            $table->unsignedBigInteger('occasion_pricing_id');
            $table->unsignedBigInteger('room_type_id');
 
            $table->foreign('occasion_pricing_id')->references('id')->on('occasion_pricings');
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
        Schema::dropIfExists('occasion_pricing__room_types');
    }
}
