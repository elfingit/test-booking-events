<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $file = \ReservationService::buildLogoFilePathFromPlace($this->place) . $this->logo_file;

        $data = [
            'id'        => $this->id,
            'place_id'  => $this->place_id,
            'logo'      => \Storage::disk('public')
                                   ->url($file)
        ];

        return $data;
    }
}
