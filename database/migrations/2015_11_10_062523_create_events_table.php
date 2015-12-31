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
            $table->string('event_photo')->nullable();
            $table->string('organizer')->nullable();
            $table->string('organizer_link')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('timezone')->nullable();
            $table->string('event_format')->nullable();
            $table->integer('max_people_number')->unsigned();
            $table->string('country')->nullable();
            $table->string('country_name')->nullable();
            $table->string('event_invite')->nullable();
            $table->timestamps();
            $table->timestamp('published_at');
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
