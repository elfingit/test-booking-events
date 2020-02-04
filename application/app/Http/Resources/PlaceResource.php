<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'price'         => $this->price,
            'position_x'    => $this->position_x,
            'position_y'    => $this->position_y,
            'reservation'   => ReservationResource::make($this->reserve)
        ];
    }
}
