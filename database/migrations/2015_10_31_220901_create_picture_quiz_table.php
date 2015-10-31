<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_quiz', function(Blueprint $table){

            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->integer('picture_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('quiz')->onDelete('cascade');
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
            $table->dropForeign('picture_quiz_quiz_id_foreign');
            $table->dropForeign('picture_quiz_picture_id_foreign');
        });
    }
}
