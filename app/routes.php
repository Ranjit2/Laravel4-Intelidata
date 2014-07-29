<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * ROOT
 */
Route::get('/', function(){
	return View::make('index');
});

Route::get('formulario', function(){
	return View::make('formulario');
});

Route::get('/graf1', function () {
	// Func::printr(Carbon::today()->subMonths(6)->month);
	Func::printr(Cliente::productosPorMes('1', 7));
});

/**
 * LOGIN
 */
Route::get('login', 'HomeController@showLogin');
Route::post('login', 'HomeController@doLogin');
Route::get('logout', 'HomeController@doLogout');

/**
* CHARTS
*/
Route::post('/getChartPie/{id}/{type}/{mes?}', 'GraffController@getChartPie');
Route::post('/getChartSerial/{id}/{type}', 'GraffController@getChartSerial');