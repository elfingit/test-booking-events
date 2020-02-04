<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventLocationResource extends JsonResource
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
            'title'         => $this->title,
            'description'   => $this->description,
            'lat'           => $this->latitude,
            'long'          => $this->longitude,
            'started_at'    => $this->started_at->format('d-m-Y H:i'),
            'end_at'        => $this->end_at->format('d-m-Y H:i')
        ];
    }
}
