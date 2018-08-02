<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrolleyHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trolley_history', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trolley_ml_id')->unsigned()->nullable();
            $table->foreign('trolley_ml_id')->references('id')->on('trolley_ml');

            $table->integer('user_current_location_id')->unsigned()->nullable();  //User Location during Creation
            $table->foreign('user_current_location_id')->references('id')->on('locations');

            $table->integer('user_defined_location_id')->unsigned()->nullable();  //If user want to define his location
            $table->foreign('user_defined_location_id')->references('id')->on('locations'); //not needed maybe?

            $table->string('status')->index(); // forreturn || samelocation
            
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
        Schema::dropIfExists('trolley_history');
    }
}
