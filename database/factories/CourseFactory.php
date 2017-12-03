<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 100),
        'slug' => $faker->slug,
        'short_description' => $faker->text($maxNbChars = 240),
        'description' => $faker->text($maxNbChars = 4000),
        'difficulty' => $faker->numberBetween(1,3),
        'prerequisites' => json_encode($faker->sentences($nb = 6, $asText = false)),
        'purpose' => $faker->text($maxNbChars = 2000),
        'purpose_what_will_learn' => json_encode($faker->sentences($nb = 6, $asText = false)),
        'target_class_level' => $faker->numberBetween(0,4),
        'image_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'user_id' => 11, // only sandel user
    ];
});
