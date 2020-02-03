<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventLocationResource;
use App\Model\EventLocation;

class EventsController extends Controller
{
    public function index()
    {
        $events = \EventLocationService::list();

        return EventLocationResource::collection($events);
    }

    public function show(EventLocation $event)
    {
        return EventLocationResource::make($event);
    }
}
