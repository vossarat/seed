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

Route::get('welcome/{locale}', function ($locale) {
    App::setLocale($locale);
    return redirect()->back();
});

Route::get('/','OrderController@index')->name('home');

Route::resource('order','OrderController');
Route::resource('wagon','WagonController');
Route::resource('trader','TraderController');
Route::resource('farmer','FarmerController');
Route::resource('forwarder','ForwarderController');

Route::get('/xxx', function () {
    return view('layouts.sysmessage')->with('message','Страница в разработке ... ');
})->name('xxx');

Route::get('/feedback', function () {
    return view('feedback.index');
})->name('feedback');
Route::post('/feedback','FeedbackController@send')->name('feedback_send');

/*Route::get('/dashboard', function () {
    return view('dashboard.template');
})->name('dashboard');*/

Route::prefix('dashboard')->middleware('dashboard')->group(
	function ()
	{
	    /*Route::get('/', function () {
		    return view('dashboard.template');
		})->name('dashboard');*/
		Route::get('/','DashboardController@index')->name('dashboard');
	    Route::resource('/dashboard_user', 'Dashboard\UserController');
	    Route::resource('/dashboard_trader', 'Dashboard\TraderController');
	    Route::resource('/dashboard_farmer', 'Dashboard\FarmerController');
	    Route::resource('/dashboard_forwarder', 'Dashboard\ForwarderController');
	    Route::resource('/country', 'Reference\CountryController');
	    Route::resource('/state', 'Reference\StateController');
	    Route::resource('/region', 'Reference\RegionController');
	    Route::resource('/town', 'Reference\TownController');
	    Route::resource('/elevator','ElevatorController');
	    Route::resource('/corn','Reference\CornController');
	    Route::resource('/post','PostController');
	    Route::resource('/rate','Reference\RateController');
	    Route::resource('/gost','Reference\GostController');
	    Route::resource('/attribute','Reference\AttributeController');
	}
);

Route::prefix('mapelevator')->group(
	function ()
	{
	    Route::get('/','MapElevatorController@index')->name('mapelevator');
		Route::get('/fav','MapElevatorController@index')->name('favelevator');
	}
);

Route::get('/news','ArticleController@index')->name('news');
Route::get('/news/{id}', 'ArticleController@show')->name('onepost');

Route::get('/help', function () {
    return view('layouts.help');
})->middleware('auth')->name('help');

Route::get('/setlocale/{locale}', function ($locale) {
    // Проверяем, что у пользователя выбран доступный язык 
    //if (in_array($locale, \Config::get('app.locales'))) {   
    	Session::put('locale', $locale); // И устанавливаем его в сессии под именем locale
    //}
    return redirect()->back();
});
