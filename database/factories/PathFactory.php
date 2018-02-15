<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Path::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text($maxNbChars = 800),
        'category_id' => $faker->numberBetween(1, 9),
        'image_id' => function () {
            return App\Media::all()->random()->id;
        },
    ];
});
