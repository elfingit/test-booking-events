<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function scopeByEvent($query, EventLocation $event)
    {
        $query->where('event_location_id', $event->id);
    }
}
