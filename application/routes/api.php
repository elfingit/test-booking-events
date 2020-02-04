<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/events', 'Api\EventsController@index');
Route::get('/events/{event}', 'Api\EventsController@show');

Route::get('/events/{event}/place', 'Api\PlacesController@index');

Route::post('/reserve_place', 'Api\ReservationController@store');
