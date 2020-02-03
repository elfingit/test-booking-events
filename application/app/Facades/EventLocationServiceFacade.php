<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 15:12
 */
namespace App\Facades;

use App\Contracts\EventLocationServiceContract;
use Illuminate\Support\Facades\Facade;

class EventLocationServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EventLocationServiceContract::class;
    }
}
