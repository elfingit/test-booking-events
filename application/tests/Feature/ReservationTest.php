<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Model\EventLocation;
use App\Model\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function testReservationValidationFailure()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $response = $this->json('POST','/api/reserve_place', [
           'company_name' => '',
           'contact_name' => '',
           'email' => '',
           'phone' => '',
           'logo_file' => '',
           'place_id' => ''
        ]);

        $response->assertStatus(422)
            ->assertExactJson([
                'message'   => 'The given data was invalid.',
                'errors'    => [
                    'company_name' => ['The company name field is required.'],
                    'contact_name' => ['The contact name field is required.'],
                    'email' => ['The email field is required.'],
                    'phone' => ['The phone field is required.'],
                    'logo_file' => ['The logo file field is required.'],
                    'place_id' => ['The place id field is required.'],
                ]
            ]);
    }

    public function testReservationValidationFailureEmail()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'and',
            'phone' => '375259759933',
            'logo_file' => '',
            'place_id' => 1001
        ]);

        $response->assertStatus(422)
                 ->assertExactJson([
                     'message'   => 'The given data was invalid.',
                     'errors'    => [
                         'email' => ['The email field is required.']
                     ]
                 ]);
    }
}
