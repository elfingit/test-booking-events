<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventLocationResource;

class EventsController extends Controller
{
    public function index()
    {
        $events = \EventLocationService::list();

        return EventLocationResource::collection($events);
    }
}
