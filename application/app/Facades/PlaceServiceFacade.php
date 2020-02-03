<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 19:59
 */
namespace App\Facades;

use App\Contracts\PlaceServiceContract;
use Illuminate\Support\Facades\Facade;

class PlaceServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PlaceServiceContract::class;
    }
}
