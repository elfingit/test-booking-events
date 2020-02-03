<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2/3/20
 * Time: 15:06
 */

namespace App\Contracts;

use Illuminate\Support\Collection;

interface EventLocationServiceContract
{
    public function list(): Collection;
}
