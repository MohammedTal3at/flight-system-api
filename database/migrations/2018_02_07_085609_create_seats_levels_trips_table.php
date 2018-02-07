<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsLevelsTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats_levels_trips', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('price');
            $table->integer('available_count');

            $table->integer('trip_id')->unsigned();
            $table->integer('seats_levels_id')->unsigned();

            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('seats_levels_id')->references('id')->on('seats_levels');
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
        Schema::drop('seats_levels_trips', function (Blueprint $table) {
            //
        });
    }
}
