<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /**
     * posibil sa fie adaugat ceva pentru progres in caz ca ne bate matematica :'(
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('user_id')->unsigned();;
            $table->integer('image_id')->unsigned();;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlists');
    }
}
