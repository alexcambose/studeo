<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('short_description');
            $table->text('content')->nullable();
            $table->integer('length')->nullable();
            $table->integer('thumbnail_id')->unsigned();
            $table->integer('video_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('order_index');
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('media');
            $table->foreign('thumbnail_id')->references('id')->on('media');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
