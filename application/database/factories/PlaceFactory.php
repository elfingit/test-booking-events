<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Place::class, function (Faker $faker) {
    return [
        'id'    => 1001,
        'price' => 14.95,
        'position_x' => 0,
        'position_y' => 0,
        'event_location_id' => 1001
    ];
});
