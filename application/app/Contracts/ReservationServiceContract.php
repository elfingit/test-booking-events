<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/4/20
 * Time: 09:45
 */
namespace App\Contracts;

use App\Model\Place;
use App\Model\PlaceReservation;
use Illuminate\Foundation\Http\FormRequest;

interface ReservationServiceContract
{
    public function create(FormRequest $request): PlaceReservation;
    public function buildLogoFilePathFromRequest(FormRequest $request): string;
    public function buildLogoFilePathFromPlace(Place $place): string;
}
