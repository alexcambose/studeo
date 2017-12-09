<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Playlist::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text($maxNbChars = 200),
        'user_id' => function () {
            return App\User::all()->random()->id;
        },
        'image_id' => function () {
            return App\Media::all()->random()->id;
        },
    ];
});
