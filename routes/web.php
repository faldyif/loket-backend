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

Route::get('/', function () {
    return view('welcome');
});

Route::post('location/create', 'LocationController@store');
Route::post('event/create', 'EventController@store');
Route::get('event/get_info', 'EventController@index');
Route::get('transaction/get_info', 'EventController@index');
Route::post('transaction/purchase', 'TransactionController@store');
Route::post('event/ticket/create', 'TicketTypeController@store');