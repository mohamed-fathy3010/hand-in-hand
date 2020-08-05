<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        //
        'user_id'=>$faker->numberBetween(1,50),
        'title'=>$faker->name,
        'description'=>$faker->sentence(),
        'price'=>$faker->randomFloat(2,0,99999),
        'phone'=>$faker->randomNumber(),
        'facebook'=>$faker->url(),
        'image'=>$faker->imageUrl(),
        'created_at'=>$faker->dateTime,
        'updated_at'=>$faker->dateTime,
        'is_canceled'=> 0,
        'reports'=> 0
    ];
});
