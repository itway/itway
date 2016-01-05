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
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->string('speeker_link')->nullable();
            $table->string('speeker_company')->nullable();
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
            $table->dropForeign('event_speekers_event_id_foreign');
        });
    }
}
