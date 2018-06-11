<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->dropColumn('dob');
            $table->string('address');
            $table->integer('city_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->string('pin',6);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
