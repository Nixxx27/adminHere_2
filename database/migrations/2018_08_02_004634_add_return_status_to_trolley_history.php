<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturnStatusToTrolleyHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trolley_history', function (Blueprint $table) {
            $table->integer('is_returned')->default(0)->after('status'); // IF 0 and status if for return == NOT YET RETURN
            $table->timestamp('returned_date')->nullable()->after('is_returned');
            $table->longtext('returned_remarks')->nullable()->after('returned_date');

            $table->integer('returned_by')->unsigned()->nullable()->after('returned_remarks');
            $table->foreign('returned_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trolley_history', function (Blueprint $table) {
            //
        });
    }
}
