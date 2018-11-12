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



/**
* Увеличение счетчика просмотра заявки
* id - идентификатор завяки
* type - тип : заявка трейдера или заявка на экспедитора
*/ 
Route::get('/views/{id}/{type}', 'ApiController@addView');

// Закрытие заявки
Route::get('/closed/{id}/{type}', 'ApiController@closedOrder');  

// значение гостов по культуре
Route::get('/gost_by_corn/{corn_id}', 'ApiController@getGostsbyCorn'); 

// парсер валют
Route::get('/rates', 'ApiController@setRates');  

// временная ссылка для апдейта region_id un elevators по town_id
Route::get('/update/region_id/', 'ApiController@updateRegion');  

// временная ссылка для апдейта region_id un elevators по town_id
Route::get('/update/state_id/', 'ApiController@updateState');  