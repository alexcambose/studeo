<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_playlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playlist_id')->unsigned();;
            $table->integer('course_id')->unsigned();;
            // si daca vrei sa stii cand a fost adaugat cursul cum ...?

            $table->foreign('playlist_id')->references('id')->on('playlists');
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
        Schema::dropIfExists('course_playlist');
    }
}
