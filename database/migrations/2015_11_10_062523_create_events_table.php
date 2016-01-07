<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->longText('preamble');
            $table->string('slug');
            $table->string('locale');
            $table->string('time');
            $table->string('date');
            $table->string('youtube_link')->nullable();
            $table->string('timezone');
            $table->string('event_format');
            $table->string('city')->nullable();
            $table->string('invite')->nullable();
            $table->timestamps();
            $table->timestamp('today')->default(Carbon::today());
            $table->boolean('banned')->default(false);
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events', function(Blueprint $table) {
            $table->dropForeign('events_user_id_foreign');
            $table->dropSoftDeletes();
        });
    }
}
