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
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->text('description');
            $table->text('target_class_level')->comment("0 - altceva, 1 - generala, 2 - gimnaziu, 3 - liceu, 4 - facultate");;
            $table->text('purpose');
            $table->text('purpose_what_will_learn');
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
        // PS: Am pus-o aici ca are legatura cumva cu prima si e mai bine sa le vezi pe aman2
        // S-a mutat in migratie separata :>
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
