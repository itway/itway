<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollOptions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id')->unsigned();
            $table->text('option');
            $table->foreign('poll_id')->references('id')->on('poll')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pollOptions', function(Blueprint $table) {
            $table->dropForeign('pollOptions_poll_id_foreign');
        });
    }
}
