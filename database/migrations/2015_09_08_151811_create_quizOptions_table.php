<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('quizOptions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned();
            $table->text('option');
            $table->foreign('quiz_id')->references('id')->on('quiz')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quizOptions', function(Blueprint $table) {
            $table->dropForeign('quizOptions_quiz_id_foreign');
        });
    }
}
