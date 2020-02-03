<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 19:56
 */
namespace App\Services;

use App\Contracts\PlaceServiceContract;
use App\Model\EventLocation;
use App\Model\Place;
use Illuminate\Support\Collection;

class PlaceService implements PlaceServiceContract
{
    public function list( EventLocation $event ): Collection
    {
        return Place::byEvent($event)->get();
    }
}
