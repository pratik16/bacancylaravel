<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('events.event');
});

Route::get('get', 'EventsController@index'); // localhost:8000/

Route::post('eventsubmit', 'EventsController@submitEvents'); // localhost:8000/
