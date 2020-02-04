<?php

namespace Tests\Feature;

use App\Model\EventLocation;
use App\Model\Place;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use DatabaseMigrations;

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

        $logoImage = UploadedFile::fake()->create('logo_test.jpg', 1024 * 2);

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'and',
            'phone' => '375259759933',
            'logo_file' => $logoImage,
            'place_id' => 1001
        ]);

        $response->assertStatus(422)
                 ->assertExactJson([
                     'message'   => 'The given data was invalid.',
                     'errors'    => [
                         'email' => ['The email must be a valid email address.']
                     ]
                 ]);
    }

    public function testReservationValidationFailurePhone()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $logoImage = UploadedFile::fake()->create('logo_test.jpg', 1024 * 2);

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '375',
            'logo_file' => $logoImage,
            'place_id' => 1001
        ]);

        $response->assertStatus(422)
                 ->assertExactJson([
                     'message'   => 'The given data was invalid.',
                     'errors'    => [
                         'phone' => ['The phone must be a valid phone number']
                     ]
                 ]);
    }

    public function testReservationValidationFailureLogo()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '375259759933',
            'logo_file' => 'qwe',
            'place_id' => 1001
        ]);

        $response->assertStatus(422)
                 ->assertExactJson([
                     'message'   => 'The given data was invalid.',
                     'errors'    => [
                         'logo_file' => [
                             'The logo file must be a file.',
                             'The logo file must be a file of type: jpeg, png.'
                         ]
                     ]
                 ]);
    }

    public function testReservationValidationFailurePlace()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $logoImage = UploadedFile::fake()->create('logo_test.jpg', 1024 * 2);

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '375259759933',
            'logo_file' => $logoImage,
            'place_id' => 10
        ]);

        $response->assertStatus(422)
                 ->assertExactJson([
                     'message'   => 'The given data was invalid.',
                     'errors'    => [
                         'place_id' => ['The selected place id is invalid.']
                     ]
                 ]);
    }

    public function testAddReservation()
    {
        factory(EventLocation::class)->create();
        factory(Place::class)->create();

        $logoImage = UploadedFile::fake()->create('logo_test.jpg', 1024 * 2);

        $response = $this->json('POST','/api/reserve_place', [
            'company_name' => 'Test',
            'contact_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '375259759933',
            'logo_file' => $logoImage,
            'place_id' => 1001
        ]);

        $data = json_decode($response->getContent());

        $response->assertStatus(201)
                 ->assertExactJson([
                     'data' => [
                         'id'   => 1,
                         'logo' => $data->data->logo,
                         'place_id' => 1001
                     ]
                 ]);

    }
}
