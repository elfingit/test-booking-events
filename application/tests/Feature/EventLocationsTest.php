<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventLocationsTest extends TestCase
{
    public function testGetEvents()
    {
        $response = $this->get('/api/events');

        $response->assertStatus(200);

        dd($response->getContent());
    }
}
