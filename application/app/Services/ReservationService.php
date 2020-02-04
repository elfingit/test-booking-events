<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/4/20
 * Time: 09:47
 */
namespace App\Services;

use App\Contracts\ReservationServiceContract;
use App\Model\Place;
use App\Model\PlaceReservation;
use Illuminate\Foundation\Http\FormRequest;

class ReservationService implements ReservationServiceContract
{
    public function create( FormRequest $request ): PlaceReservation
    {
        $data = $request->only([
            'company_name', 'contact_name', 'email',
            'phone', 'description', 'place_id'
        ]);

        $data['logo_file'] = $this->storeLogo($request);

        return PlaceReservation::create($data);

    }

    public function buildLogoFilePathFromRequest( FormRequest $request ): string
    {
        $place = \PlaceService::getById($request->get('place_id'));
        return '/images/event_logos/' . $place->eventLocation->id . '/';
    }

    public function buildLogoFilePathFromPlace( Place $place ): string
    {
        return '/images/event_logos/' . $place->eventLocation->id . '/';
    }

    protected function storeLogo(FormRequest $request)
    {
        $fileName = \Str::random(8) . '.' . $request->file('logo_file')->extension();
        $path = $this->buildLogoFilePathFromRequest($request);

        \Storage::disk('public')
            ->put($path . $fileName, $request->file('logo_file')->get());

        return $fileName;
    }

}
