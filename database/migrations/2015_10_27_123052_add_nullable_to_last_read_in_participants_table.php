<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNullableToLastReadInParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function mySQLDB()
    {
        DB::statement('ALTER TABLE `' . DB::getTablePrefix() . 'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP;');
    }

    public static function postgreSQL()
    {
        DB::raw(
            'ALTER TABLE participants
            ALTER COLUMN last_read
            SET DEFAULT NULL;
            UPDATE participants
            SET last_read=CURRENT_TIMESTAMP;
            CREATE OR REPLACE FUNCTION update_lastmodified_column()
            RETURNS TRIGGER AS $$
            BEGIN NEW.last_read = NOW();
            RETURN NEW;
            END;
            $$LANGUAGE "plpgsql";
            CREATE TRIGGER update_lastmodified_modtime BEFORE UPDATE
            ON participants FOR EACH ROW EXECUTE PROCEDURE
            update_lastmodified_column();');
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
