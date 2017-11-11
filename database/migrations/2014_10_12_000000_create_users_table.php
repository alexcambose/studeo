<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->integer('is_male')->nullable();
            $table->integer('city')->nullable(); // https://gist.github.com/alexcambose/9343b66746e65ba592fc5b219f89631d
            $table->string('school')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->integer('image_id')->nullable();
            $table->integer('is_teacher')->nullable();
            $table->string('cover_color')->default("#");
            $table->integer('points')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
