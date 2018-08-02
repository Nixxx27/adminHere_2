<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrolleyMasterlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trolley_ml', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tracking_number')->index();

            $table->integer('tracking_series_id')->unsigned()->nullable();
            $table->foreign('tracking_series_id')->references('id')->on('tracking_series');

     
            $table->integer('user_defined_location_id')->unsigned()->nullable();  //If user want to define location
            $table->foreign('user_defined_location_id')->references('id')->on('tracking_series');

            $table->longtext('remarks')->nullable();

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
        Schema::dropIfExists('trolley_ml');
    }
}
