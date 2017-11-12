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
        'nickname' => 'Castronelul ' . $faker->userName,
        'birthday' => $faker->dateTime($max = 'now'),
        'sex' => $faker->numberBetween(0, 2),
        'city' => $faker->numberBetween(0, 41),
        'school' => 'Scoala judeteana "' . $faker->firstNameMale . ' ' .  $faker->firstNameFemale . '"',
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'description' => $faker->paragraph(4),
        'email' => $faker->unique()->safeEmail,
        'image_id' => function(){
            return factory(App\Image::class)->create()->id;
        },
        'is_teacher' => 0,
        'points' => $faker->numberBetween(0, 1000),
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];




});
$factory->define(App\Image::class, function (Faker $faker) {
    return [
//        'filename' => $faker->image('public/userdata/images/', 200, 200, 'cats'),
        'type' => 0,
        'filename' => '',
    ];
});