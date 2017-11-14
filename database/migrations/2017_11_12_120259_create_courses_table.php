<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('image_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->integer('views'); //posibil sa fie scos

        });

        /*
         *   #courses_users
         * cursurile incepute de un anumit user + progresul + lectia la care a ramas
         *
         * PS: Am pus-o aici ca are legatura cumva cu prima si e mai bine sa le vezi pe aman2
         * functie progress:current/max * 100 = %
         *
         */
        Schema::create('courses_users', function (Blueprint $table ) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('current_lesson_id')->unsigned();
            $table->integer('progress');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('courses_users');
    }
}
