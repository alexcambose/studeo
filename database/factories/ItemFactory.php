<?php
use App\Item;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->text(200),
        'price' => $faker->numberBetween(5, 99),
        'image_id' => $faker->numberBetween(1, 10)
    ];
});

//$factory->define(Model::class, function (Faker $faker) {
//    return [
//        'title' => $faker->sentence(3),
//        'description' => $faker->text(200),
//        'price' => $faker->numberBetween(5, 99),
//        'image_id' => $faker->numberBetween(1, 10)
//    ];
//});


