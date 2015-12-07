<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_trends', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->string('trend');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teams_trends', function(Blueprint $table) {

            $table->dropForeign('teams_trends_team_id_foreign');

        });
    }
}
