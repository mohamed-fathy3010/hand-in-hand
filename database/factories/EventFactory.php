<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        //
        'user_id'=>$faker->numberBetween(1,50),
        'title'=>$faker->name,
        'about'=>$faker->paragraph,
        'description'=>$faker->sentence(),
        'image'=>$faker->imageUrl(),
        'location'=>$faker->streetAddress,
        'date'=>$faker->date(),
        'time'=>$faker->time(),
        'created_at'=>$faker->dateTime,
        'updated_at'=>$faker->dateTime
    ];
});
