<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function scopeByEvent($query, EventLocation $event)
    {
        $query->where('event_location_id', $event->id);
    }

    public function eventLocation()
    {
        return $this->belongsTo(EventLocation::class, 'event_location_id', 'id');
    }

    public function reserve()
    {
        return $this->hasOne(PlaceReservation::class, 'place_id', 'id');
    }
}
