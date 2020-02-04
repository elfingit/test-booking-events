<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/4/20
 * Time: 09:48
 */

namespace App\Facades;

use App\Contracts\ReservationServiceContract;
use Illuminate\Support\Facades\Facade;

class ReservationServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ReservationServiceContract::class;
    }
}
