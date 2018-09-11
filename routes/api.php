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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// избранные элеваторы
Route::get('/fav/{action}/{user_id}/{elevator_id}', 'ApiController@favorite'); 

// заявки к элеватору
Route::get('/order_to_elevator/{action}/{order_id}/{elevator_id}', 'ApiController@orderToElevator');  

// Увеличение счетчика просмотра заявки 
Route::get('/views_order/{order_id}', 'ApiController@addViewOrder');  