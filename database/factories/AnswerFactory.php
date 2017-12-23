<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->text($maxNbChars = 120),
        'is_true' => $faker->boolean($chanceOfGettingTrue = 60),
        'question_id' => App\Question::all()->random()->id,
    ];
});
