<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'content' => $faker->text($maxNbChars = 200),
        'is_private' => $faker->boolean(),
        'user_id' => App\User::all()->random(1)->first()->id,
    ];
});
