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

// ANTES O SIN AUTENTIFICARCE
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

// DESPUES DE AUTENTIFICARCE
// Route::group(array('before' => 'auth'), function() {
	// LOGOUT
Route::get('logout', 'HomeController@doLogout');

	// FORMULARIO VIEW
Route::get('formulario', function()
{
	return View::make('formulario');
});

	// VISTA CHARTS
Route::get('/charts/pie', function(){ return View::make('charts.pie.cliente'); }); // AGREGAR VARIABLE DE SESION PARA VER LA RUTA
Route::get('/charts/column', function(){ return View::make('charts.column.cliente'); });
Route::get('/charts/stackbar', function(){ return View::make('charts.stackbar.cliente'); });
Route::get('/charts/breakchart', function(){ return View::make('charts.break.cliente'); });

	// CHARTS
Route::post('/getChartPie/{id}/{type}/{mes?}', 'GraffController@getChartPie');
Route::post('/getChartSerial/{id}/{type}', 'GraffController@getChartSerial');
Route::post('/getBreakChart/{id}', 'GraffController@getChartBreak');

	// CLIENTE
Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');
// Route::get('/montos/{id}', 'GraffController@montoTotal');

// });


Route::get('/test', function(){
	// dd(Cliente::find(7)->telefonos);
});