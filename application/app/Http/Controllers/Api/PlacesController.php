<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Model\EventLocation;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function index(EventLocation $event)
    {
        $places = \PlaceService::list($event);

        return PlaceResource::collection($places);
    }
}
