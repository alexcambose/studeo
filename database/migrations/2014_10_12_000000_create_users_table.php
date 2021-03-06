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

    /**
     * + money,exp,lvl, dar si astea mai trebuie gandite deci mai bine la facem si pe astea in clasa.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('nickname')->nullable();
            $table->integer('sex')->nullable();
            $table->integer('city')->nullable(); // https://gist.github.com/alexcambose/9343b66746e65ba592fc5b219f89631d
            $table->string('school')->nullable();
            $table->string('school_level')->nullable()->comment("0 - altceva, 1 - generala, 2 - gimnaziu, 3 - liceu, 4 - facultate");
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->integer('image_id')->unsigned();
            $table->boolean('is_teacher')->default(false);
            $table->integer('role')->default(1)->comment("1 - user, 2 - mentor, 3 - administrator");
            $table->string('cover_color')->default("#6f7ecc");
            $table->integer('xp')->default(0);
            $table->integer('coins')->default(0);
            $table->string('social')->default("{}");
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('media')->onDelete('cascade');
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
