<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterLastReadInParticipantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function mySQLDB()
    {
        DB::statement('ALTER TABLE `' . DB::getTablePrefix() . 'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL DEFAULT NULL;');
    }

    public static function postgreSQL()
    {
        DB::statement('ALTER TABLE ' . DB::getTablePrefix() . 'participants ALTER COLUMN last_read DROP DEFAULT,
         ALTER COLUMN last_read TYPE timestamp,
         ALTER COLUMN last_read SET DEFAULT NULL;');
    }

    public function up()
    {
        determineActiveDBandResolveUp($this);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
