<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'content' => $faker->text($maxNbChars = 120) . ' ?',
        'lesson_id' => App\Lesson::all()->random()->id,
    ];
});
