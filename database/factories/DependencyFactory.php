<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dependency;
use Faker\Generator as Faker;

$factory->define(Dependency::class, function (Faker $faker) {
    return [
        'vehicle_id' => 1,
        'reminder_id' => 1,
        'title' => $faker->company,
        'description' => $faker->text
    ];
});
