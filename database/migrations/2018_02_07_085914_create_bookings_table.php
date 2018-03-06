<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->enum('status', ['accepted', 'waiting','rejected']);
            $table->float('price');
            $table->integer('user_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->integer('seat_level_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('seat_level_id')->references('id')->on('seats_levels');

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
        Schema::drop('bookings', function (Blueprint $table) {
            //
        });
    }
}
