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

// PATTERNS
Route::pattern('id', '[0-9]+');
Route::pattern('type', '[a-z]+');
Route::pattern('mes', '[0-9]+');

// ANTES O SIN AUTENTIFICARCE
//Route::group(array('after' => 'auth'), function() {
	// ROOT
	Route::get('/', function() { return Redirect::to('/login'); });

	// LOGIN
	Route::get('/login', 'HomeController@showLogin');
	Route::post('/login', 'HomeController@doLogin');
//});

// DESPUES DE AUTENTIFICARCE
//Route::group(array('before' => 'auth'), function() {
	// ROOT
	Route::get('/', function() { return Redirect::to('/home'); });

	// LOGOUT
	Route::get('/logout', 'HomeController@doLogout');

	// HOME VIEW
	Route::get('/home', function() { return View::make('home'); });

	// CHARTS VIEWS
	Route::get('/charts/pie', function(){ return View::make('charts.pie.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/column', function(){ return View::make('charts.column.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/stackbar', function(){ return View::make('charts.stackbar.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/breakchart', function(){ return View::make('charts.break.'.Session::get('ses_user_tipo')); });

	// CHARTS REQUESTS
	// CLIENT
	Route::post('/getChartPie/{id}/{type?}/{mes?}', 'GraffController@getChartPie');
	Route::post('/getChartSerial/{id}/{type?}', 'GraffController@getChartSerial');

	// ENTERPRISE
	Route::post('/getChartPieEnt/{id}/{type?}/{mes?}', 'GraffController@getChartPie');
	Route::post('/getSerialChartEnt/{id}/{type?}', 'GraffController@getSerialChartEnt');


	// --------------------------------------------------------------------------------------------------------

	// CLIENTE
	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');


    Route::get('/test', function(){ dd(Cliente::find(7)->telefonos); });

//});
	Route::post('/telefonosServicios/{idCliente}/{fecha?}', 'GraffController@getChartBroke');

