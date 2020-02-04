<?php

namespace Tests\Feature;

use App\Model\EventLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventLocationsTest extends TestCase
{
    use RefreshDatabase;

    public function testGetEvents()
    {
        factory(EventLocation::class)->create();

        $response = $this->get('/api/events');

        $response->assertStatus(200)
            ->assertExactJson([
                'data'  => [
                    [
                        'id'    => 1001,
                        'title' => 'Test event',
                        'description' => 'test event descr',
                        'started_at'  => '03-02-2020 14:00',
                        'end_at'      => '17-02-2020 14:00',
                        'lat'         => '27.535460',
                        'long'        => '57.333300'
                    ]
                ]
            ]);
    }

    public function testGetEvent()
    {
        factory(EventLocation::class)->create();
        $response = $this->get('/api/events/1001');

        $response->assertStatus(200)
                 ->assertExactJson([
                     'data'  => [
                             'id'    => 1001,
                             'title' => 'Test event',
                             'description' => 'test event descr',
                             'started_at'  => '03-02-2020 14:00',
                             'end_at'      => '17-02-2020 14:00',
                             'lat'         => '27.535460',
                             'long'        => '57.333300'
                     ]
                 ]);
    }
}
