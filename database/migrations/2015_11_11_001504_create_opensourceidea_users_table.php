<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpensourceideaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::create('opensourceidea_users', function(Blueprint $table){
            $table->increments('id');
            $table->integer('opensourceidea_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('opensourceidea_id')->references('id')->on('opensourceidea')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opensourceidea_users', function(Blueprint $table){
            $table->dropForeign('opensourceidea_users_user_id_foreign');
            $table->dropForeign('opensourceidea_users_events_id_foreign');
        });
    }
}
