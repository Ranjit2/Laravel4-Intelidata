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
	// Func::printr(Cliente::productosPorMes('1', 7));
	// DB::table('cliente')->where('id', '=', 1)->update(array('clave' => Hash::make('111-1')))->;
	// DB::table('cliente')->where('id', '=', 2)->update(array('clave' => Hash::make('222-2')));
	// DB::table('cliente')->where('id', '=', 3)->update(array('clave' => Hash::make('333-3')));
	// DB::table('cliente')->where('id', '=', 4)->update(array('clave' => Hash::make('444-4')));
	// DB::table('cliente')->where('id', '=', 5)->update(array('clave' => Hash::make('555-5')));
	// DB::table('cliente')->where('id', '=', 6)->update(array('clave' => Hash::make('666-6')));
	// DB::table('cliente')->where('id', '=', 7)->update(array('clave' => Hash::make('11111-1')));
	// DB::table('cliente')->where('id', '=', 8)->update(array('clave' => Hash::make('22222-2')));
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


Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');

Route::get('/montos/{fono}', 'GraffController@montoTotal');

