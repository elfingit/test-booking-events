<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\EventLocation::class, function (Faker $faker) {
    return [
        'id'    => 1001,
        'title' => 'Test event',
        'description' => 'test event descr',
        'latitude'  => 27.53546,
        'longitude'  => 57.3333,
        'started_at'  => \Carbon\Carbon::parse('03-02-2020 14:00:00'),
        'end_at'  => \Carbon\Carbon::parse('17-02-2020 14:00:00'),
    ];
});
