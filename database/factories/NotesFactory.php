<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'user_id' => App\User::where('first_name' ,'Sandel')->first()->id,
        'course_id' => App\Course::all()->random()->id,
        'title' => $faker->text($maxNbChars = 100),
        'content' => $faker->text($maxNbChars = 200),
    ];
});
