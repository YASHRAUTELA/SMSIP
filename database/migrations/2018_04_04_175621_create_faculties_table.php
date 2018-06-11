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
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('father_name',50);
            $table->string('mother_name',50);
            $table->date('dob');
            $table->date('doj');
            $table->integer('dept_id')->unsigned();
            $table->string('contact',12);
            $table->timestamps();
        });

        Schema::table('faculties',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dept_id')->references('id')->on('departments');
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
