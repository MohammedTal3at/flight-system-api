<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips_place', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
            $table->integer('trip_id')->unsigned();

            $table->foreign('from')->references('id')->on('places');
            $table->foreign('to')->references('id')->on('places');
            $table->foreign('trip_id')->references('id')->on('trips');

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
        Schema::dropIfExists('trips_place');
    }
}
