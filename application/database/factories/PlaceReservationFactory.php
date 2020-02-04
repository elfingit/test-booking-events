<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\PlaceReservation::class, function (Faker $faker) {
    return [
        'id'    => 1001,
        'company_name' => 'BMW',
        'contact_name' => 'Andrey',
        'email' => 'test@test.com',
        'phone' => '375259769933',
        'description' => 'test descr',
        'logo_file' => 'logo.jpg',
        'place_id' => 1001
    ];
});
