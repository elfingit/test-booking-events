<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PlaceReservationStoreRequest;

class ReservationController extends Controller
{
    public function store(PlaceReservationStoreRequest $request)
    {
        $reservation = \ReservationService::create($request);
    }
}
