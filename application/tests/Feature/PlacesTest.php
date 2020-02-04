<?php

namespace Tests\Feature;

use App\Model\EventLocation;
use App\Model\Place;
use App\Model\PlaceReservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlacesTest extends TestCase
{
    use RefreshDatabase;

    public function testPlaces()
    {
        factory(EventLocation::class)->create();

        factory(Place::class)->create();
        factory(Place::class)->create([
            'id'    => 1002,
            'price' => 15,
            'position_x' => 80
        ]);

        factory(Place::class)->create([
            'id'    => 1003,
            'price' => 15.45,
            'position_x' => 160
        ]);

        $response = $this->get('/api/events/1001/place');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    [
                        'id'    => 1001,
                        'price' => '14.95',
                        'position_x' => 0,
                        'position_y' => 0,
                        'reservation' => null
                    ],
                    [
                        'id'    => 1002,
                        'price' => '15.00',
                        'position_x' => 80,
                        'position_y' => 0,
                        'reservation' => null
                    ],
                    [
                        'id'    => 1003,
                        'price' => '15.45',
                        'position_x' => 160,
                        'position_y' => 0,
                        'reservation' => null
                    ],
                ]
            ]);
    }

    public function testPlacesWithReservation()
    {
        factory(EventLocation::class)->create();

        factory(Place::class)->create();

        factory(PlaceReservation::class)->create();

        $response = $this->get('/api/events/1001/place');

        $response->assertStatus(200)
                 ->assertExactJson([
                     'data' => [[
                         'id'    => 1001,
                         'price' => '14.95',
                         'position_x' => 0,
                         'position_y' => 0,
                         'reservation' => [
                             'id'   => 1001,
                             'logo' => 'http://localhost/storage/images/event_logos/1001/logo.jpg',
                             'place_id' => 1001
                         ]
                     ]]
                 ]);
    }
}
