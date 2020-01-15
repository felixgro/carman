<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'vehicle_id' => 1,
        'expense_type_id' => $faker->numberBetween(1, count(\App\ExpenseType::all())),
        'title' => $faker->company,
        'description' => $faker->text,
        'amount' => $faker->numberBetween(NULL, 10, 250)
    ];
});
