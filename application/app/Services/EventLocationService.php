<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 15:09
 */

namespace App\Services;

use App\Contracts\EventLocationServiceContract;
use App\Model\EventLocation;
use Illuminate\Support\Collection;

class EventLocationService implements EventLocationServiceContract
{
    public function list(): Collection
    {
        return EventLocation::all();
    }

}
