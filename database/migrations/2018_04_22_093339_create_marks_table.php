<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('obtained_marks')->unsigned();
            $table->integer('total_marks')->unsigned()->default(100);
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('semester_id')->references('id')->on('semesters');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
