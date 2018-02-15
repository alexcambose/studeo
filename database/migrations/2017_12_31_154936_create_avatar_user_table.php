<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatarUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatar_user', function (Blueprint $table) {
            $table->string('avatar_type');
            $table->integer('user_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->primary(['user_id', 'avatar_type']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('avatar_type')->references('type')->on('avatars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatar_user');
    }
}
