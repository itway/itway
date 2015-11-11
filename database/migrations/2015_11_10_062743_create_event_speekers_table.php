<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSpeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_speekers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('events_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->string('speeker_logo')->nullable();
            $table->string('speeker_link');
            $table->string('speeker_company');
            $table->string('speeker_skills')->nullable();
            $table->timestamps();
            $table->timestamp('published_at');
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
        Schema::drop('event_speekers', function(Blueprint $table) {

            $table->dropForeign('event_speekers_events_id_foreign');
        });
    }
}
