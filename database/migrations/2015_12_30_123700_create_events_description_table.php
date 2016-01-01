<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_description', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('events_id')->unsigned();
            $table->longText('description');
            $table->softDeletes();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_description', function(Blueprint $table) {
            $table->dropForeign('events_description_events_id_foreign');
            $table->dropSoftDeletes();
        });
    }
}
