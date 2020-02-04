<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlaceReservation extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
