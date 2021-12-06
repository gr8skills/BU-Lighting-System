<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLightSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_systems', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->default(0); //On=1, Off=0
            $table->string('power_consumption')->nullable(); //how much power the light is currently consuming
            $table->string('schedule')->nullable(); //when the light turns on/off itself
            $table->string('health')->nullable(); //0=bad, 1=average, 2=good
            $table->timestamps();
            $table->softDeletes();
        });

        //seed light with example data
        Model::unguard();
        $light = [
            [
                'id'         => '1',
                'location'      => 'Ilishan Remo',
                'name'      => 'Dummy Light',
                'status'      => 0,
                'power_consumption'      => '0 Watt',
                'schedule'      => 'Now',
                'health'      => 'Good',
                'created_at' => '2021-11-01 14:00:26',
                'updated_at' => '2019-11-01 14:00:26',
            ],
        ];
        DB::table('light_systems')->insert($light);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_systems');
    }
}
