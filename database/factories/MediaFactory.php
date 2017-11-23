<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Media::class, function (Faker $faker) {
    return [
//        'filename' => $faker->image('public/userdata/images/', 200, 200, 'people'),
        'type' => 0,
        'filename' => 'userdata/images/' . $faker->numberBetween(0, 10) . '.jpg',
    ];
});
