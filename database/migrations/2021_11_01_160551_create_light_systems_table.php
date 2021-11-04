<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
