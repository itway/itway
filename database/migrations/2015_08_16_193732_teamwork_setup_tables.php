<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class TeamworkSetupTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( \Config::get( 'auth.table' ), function ( Blueprint $table )
        {
            $table->integer( 'current_team_id' )->unsigned()->nullable();
        } );

        Schema::create( \Config::get( 'teamwork.team_invites_table' ), function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->enum('type', ['invite', 'request']);
            $table->string('email');
            $table->string('accept_token');
            $table->string('deny_token');
            $table->timestamps();
        });

        Schema::create( \Config::get( 'teamwork.teams_table' ), function ( $table )
        {
            $table->increments( 'id' )->unsigned();
            $table->integer( 'owner_id' )->unsigned()->nullable();
            $table->string( 'name' );
            $table->string('slug');
            $table->string('locale');
            $table->timestamp('date')->default(Carbon::today());
            $table->boolean('banned')->default(false);
            $table->string('country');
            $table->string('country_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create( \Config::get( 'teamwork.team_user_table' ), function ( $table )
        {
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'team_id' )->unsigned();

            $table->foreign( 'user_id' )
                ->references( \Config::get( 'teamwork.user_foreign_key' ) )
                ->on( \Config::get( 'auth.table' ) )
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->foreign( 'team_id' )->references( 'id' )->on( \Config::get( 'teamwork.teams_table' ) );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\Config::get('auth.table'), function(Blueprint $table)
        {
            $table->dropColumn('current_team_id');
        });

        Schema::table(\Config::get('teamwork.team_user_table'), function (Blueprint $table) {
            $table->dropForeign(\Config::get('teamwork.team_user_table').'_user_id_foreign');
            $table->dropForeign(\Config::get('teamwork.team_user_table').'_team_id_foreign');
        });

        Schema::drop(\Config::get('teamwork.team_user_table'));
        Schema::drop(\Config::get('teamwork.teams_table'), function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::drop(\Config::get('teamwork.team_invites_table'));

    }
}
