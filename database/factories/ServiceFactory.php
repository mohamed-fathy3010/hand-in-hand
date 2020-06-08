<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1, 50),
        'title' => $faker->name,
        'description' => $faker->sentence(),
        'price' => $faker->randomFloat(2, 0, 99999),
        'goal'=>$faker->numberBetween(10,100),
        'target'=>$faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});
