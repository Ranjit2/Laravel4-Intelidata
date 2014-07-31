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

// Route::group(array('after' => 'auth'), function() {
	// ROOT
	Route::get('/', function()
	{
		return View::make('index');
	});

	// LOGIN
	Route::get('login', 'HomeController@showLogin');
	Route::post('login', 'HomeController@doLogin');
// });

// Route::group(array('before' => 'auth'), function() {
	// LOGOUT
	Route::get('logout', 'HomeController@doLogout');

	// FORMULARIO VIEW
	Route::get('formulario', function()
	{
		return View::make('formulario');
	});

	// CHARTS
	Route::post('/getChartPie/{id}/{type}/{mes?}', 'GraffController@getChartPie');
	Route::post('/getChartSerial/{id}/{type}', 'GraffController@getChartSerial');

	// CLIENTE
	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');
	Route::get('/montos/{fono}', 'GraffController@montoTotal');
// });