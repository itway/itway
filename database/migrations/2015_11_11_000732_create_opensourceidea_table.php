<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateOpensourceideaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('opensourceidea', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->string('github_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('doc')->nullable();
            $table->timestamp('date')->default(Carbon::today());
            $table->boolean('banned')->default(false);
            $table->timestamps();
            $table->timestamp('published_at');
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
         Schema::drop('opensourceidea', function(Blueprint $table) {

            $table->dropForeign('opensourceidea_user_id_foreign');
            $table->dropSoftDeletes();

        });
    }
}
