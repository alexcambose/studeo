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
            $table->text('shortDescription');
            $table->text('description');
            $table->integer('rating');
            $table->text('targetClassLevel')->comment("0 - altceva, 1 - generala, 2 - gimnaziu, 3 - liceu, 4 - facultate");;
            $table->text('purpose');
            $table->text('purposeWhatWillLearn');
            $table->text('prerequisites');
            $table->text('difficulty')->comment("1 - Usor, 2 - Mediu, 3 - Greu");
            $table->boolean('is_private')->default(0);
            $table->integer('image_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('views')->default(0); // posibil sa fie scos
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('media');
            $table->foreign('user_id')->references('id')->on('users');

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
            $table->integer('progress'); // useless daca folosim formula... sterge tu
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_users');
        Schema::dropIfExists('courses');
    }
}
