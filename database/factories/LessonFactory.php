<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Lesson::class, function (Faker $faker) {
    static $order;
    return [
        'title' => $faker->text($maxNbChars = 100),
        'short_description' => $faker->text($maxNbChars = 240),
        'content' => $faker->text($maxNbChars = 4000),
        'length' => $faker->numberBetween(100, 1000),
        'thumbnail_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'video_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'course_id' => App\Course::all()->random()->id,
        'order_index' => ++$order - 1,
    ];
});
