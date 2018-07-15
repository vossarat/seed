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

Artisan::call('route:clear');
Artisan::call('view:clear');

Auth::routes();

Route::get('/','OrderController@index')->name('home');
Route::resource('order','OrderController');
Route::resource('trader','TraderController');
Route::resource('farmer','FarmerController');
Route::resource('elevator','ElevatorController');

Route::get('/xxx', function () {
    return view('layouts.constraction');
})->name('xxx');

/*Route::get('/dashboard', function () {
    return view('dashboard.template');
})->name('dashboard');*/

Route::prefix('dashboard')->middleware('dashboard')->group(
	function ()
	{
	    Route::get('/', function () {
		    return view('dashboard.template');
		})->name('dashboard');
	    Route::get('/user', 'UserController@index');
	}
);

//Route::get('/home', 'HomeController@index')->name('home');
