<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 100),
        'shortDescription' => $faker->text($maxNbChars = 240),
        'content' => $faker->text($maxNbChars = 4000),
        'thumbnail_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'video_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'course_id' => App\Course::all()->random()->id,
        'order_index' => time() % 10,
    ];
});
