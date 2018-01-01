<?php

use Faker\Generator as Faker;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->userName,
        'nickname' => $faker->userName,
        'birthday' => $faker->iso8601($max = '-8 years'),
        'sex' => $faker->numberBetween(0, 2),
        'city' => $faker->numberBetween(0, 41),
        'school' => 'Scoala judeteana "' . $faker->firstNameMale . ' ' .  $faker->firstNameFemale . '"',
        'school_level' => $faker->numberBetween(0, 4),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'description' => $faker->text($maxNbChars = 250),
        'email' => $faker->unique()->safeEmail,
        'image_id' => function() {
            return factory(App\Media::class)->create()->id;
        },
        'is_teacher' => 0,
        'xp' => $faker->numberBetween(100, 1000),
        'coins' => 500,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});
