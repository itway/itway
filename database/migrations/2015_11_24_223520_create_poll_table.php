<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreatePollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('hint')->nullable();
            $table->string('locale');
            $table->string('slug');
            $table->timestamps();
            $table->timestamp('published_at');
            $table->integer('pollable_id');
            $table->string('pollable_type');
            $table->timestamp('date')->default(Carbon::today());
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('poll', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
