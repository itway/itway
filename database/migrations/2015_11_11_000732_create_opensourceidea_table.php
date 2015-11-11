<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('repository_link')->nullable();
            $table->string('doc')->nullable();
            $table->string('openidea_photo');
            $table->string('speeker_skills')->nullable;
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
