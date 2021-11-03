<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGpsLocationToLightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('light_systems', ['gmap_location', 'gps_location'])) {
            Schema::table('light_systems', function (Blueprint $table) {
                $table->string('gmap_location')->after('health')->nullable(); //google map
                $table->string('gps_location')->after('gmap_location')->nullable(); //longitude && Latitude
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('light_systems', ['gmap_location', 'gps_location'])) {
            Schema::table('light_systems', function (Blueprint $table) {
                $table->dropColumn('gmap_location'); //google map
                $table->dropColumn('gps_location'); //longitude && Latitude
            });
        }
    }
}
