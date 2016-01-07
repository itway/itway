<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_speakers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('events_id')->unsigned();
            $table->string('user_slug')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('speaker_link')->nullable();
            $table->string('speaker_company')->nullable();
            $table->string('speaker_description')->nullable();
            $table->timestamps();
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
        Schema::drop('event_speakers', function(Blueprint $table) {
            $table->dropForeign('event_speakers_events_id_foreign');
        });
    }
}
