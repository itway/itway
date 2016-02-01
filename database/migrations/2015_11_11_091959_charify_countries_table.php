<?php

use Illuminate\Database\Migrations\Migration;

class CharifyCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public static function mySQLDB()
    {
        Schema::table(\Config::get('countries.table_name'), function ($table) {
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY country_code CHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY iso_3166_2 CHAR(2) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY iso_3166_3 CHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY region_code CHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY sub_region_code CHAR(3) NOT NULL DEFAULT ''");
        });
    }

    public static function downmySQLDB()
    {

        Schema::table(\Config::get('countries.table_name'), function ($table) {
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY country_code VARCHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY iso_3166_2 VARCHAR(2) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY iso_3166_3 VARCHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY region_code VARCHAR(3) NOT NULL DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " MODIFY sub_region_code VARCHAR(3) NOT NULL DEFAULT ''");
        });
    }

    public static function postgreSQL()
    {
        Schema::table(\Config::get('countries.table_name'), function ($table) {
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN country_code TYPE CHAR(3), ALTER COLUMN country_code SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN iso_3166_2 TYPE CHAR(2), ALTER COLUMN iso_3166_2 SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN iso_3166_3 TYPE CHAR(3), ALTER COLUMN iso_3166_3 SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN region_code TYPE CHAR(3), ALTER COLUMN region_code SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN sub_region_code TYPE CHAR(3), ALTER COLUMN sub_region_code SET DEFAULT ''");
        });
    }

    public static function downpostgreSQL()
    {

        Schema::table(\Config::get('countries.table_name'), function ($table) {
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN country_code TYPE VARCHAR(3), ALTER COLUMN country_code SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN iso_3166_2 TYPE VARCHAR(2), ALTER COLUMN iso_3166_2 SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN iso_3166_3 TYPE VARCHAR(3), ALTER COLUMN iso_3166_3 SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN region_code TYPE VARCHAR(3), ALTER COLUMN region_code SET DEFAULT ''");
            DB::statement("ALTER TABLE " . DB::getTablePrefix() . \Config::get('countries.table_name') . " ALTER COLUMN sub_region_code TYPE VARCHAR(3), ALTER COLUMN sub_region_code SET DEFAULT ''");
        });

    }

    public function up()
    {
        determineActiveDBandResolveUp($this);
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        determineActiveDBandResolveDown($this);
    }

}
