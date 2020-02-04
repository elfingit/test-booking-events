<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 19:55
 */

namespace App\Contracts;

use App\Model\EventLocation;
use App\Model\Place;
use Illuminate\Support\Collection;

interface PlaceServiceContract
{
    public function list(EventLocation $event): Collection;
    public function getById($id): Place;
}
