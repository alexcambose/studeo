<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_user', function (Blueprint $table ) {
            $table->string('achievement_type')->unique();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->primary(['achievement_type', 'user_id']);
            $table->foreign('achievement_type')->references('type')->on('achievements');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievement_user');
    }
}
