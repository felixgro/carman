<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $v = $faker->vehicleArray();

    return [
        'user_id' => 1,
        'vehicle_type_id' => $faker->numberBetween(1, count(\App\VehicleType::all())),
        'vehicle_fuel_id' => $faker->numberBetween(1, count(\App\VehicleFuel::all())),
        'setting_id' => null,
        'vehicle_manufacture_id' => $faker->numberBetween(1, count(\App\VehicleManufacture::all())),
        'model' => $v['model'],
        'plate' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
        'km' => $faker->randomNumber()
    ];
});
