<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'staff'], function () {

        Route::get('/tickets/assigned', 'AssignedTicketController@index');

        Route::get('/group/{group}/tickets', 'GroupTicketController@index');

    });

    Route::get('/tickets', 'TicketController@index');
    Route::post('/tickets', 'TicketController@store');
    Route::get('/tickets/{ticket}', 'TicketController@show');


});
