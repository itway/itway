<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('picture_event', function(Blueprint $table){

            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('picture_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('picture_quiz', function(Blueprint $table){
            $table->dropForeign('picture_event_event_id_foreign');
            $table->dropForeign('picture_event_picture_id_foreign');
        });
    }
}
