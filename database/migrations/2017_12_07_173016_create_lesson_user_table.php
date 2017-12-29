<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *   #course_user
         * cursurile incepute de un anumit user + progresul + lectia la care a ramas
         *
         * functie progress:current/max * 100 = %
         *
         */
        Schema::create('lesson_user', function (Blueprint $table ) {
            $table->integer('user_id')->unsigned();
            $table->integer('lesson_id')->unsigned(); // daca am id-ul lectiei la care este am toate
            $table->timestamps();
            $table->primary(['user_id', 'lesson_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_user');
    }
}
