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
Route::pattern('año', '[0-9]+');

// ANTES O SIN AUTENTIFICARCE
Route::group(array('after' => 'auth'), function() {
	// ROOT
	Route::get('/', function() { return Redirect::to('/login'); });

	// LOGIN
	Route::get('/login', 'HomeController@showLogin');
	Route::post('/login', 'HomeController@doLogin');
});

// DESPUES DE AUTENTIFICARCE
Route::group(array('before' => 'auth'), function() {

	// ROOT
	Route::get('/', function() { return Redirect::to('/home'); });

	// LOGOUT
	Route::get('/logout', 'HomeController@doLogout');

	// PROFILE
	Route::get('/user/profile', function() { return View::make('users.profile'); });

	// HOME VIEW
	Route::get('/home', function() {
		$t = Telefono::totales();
		return View::make('home')->with('tline', $t);
	});

	// CHARTS VIEWS
	Route::get('/charts/pie', function(){ return View::make('charts.pie.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/column', function(){ return View::make('charts.column.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/stackbar', function(){ return View::make('charts.stackbar.'.Session::get('ses_user_tipo')); });
	Route::get('/charts/breakchart', function(){
		$titulares = Titular::select('tipo')->get();
		return View::make('charts.break.'.Session::get('ses_user_tipo'))->with('titulares', $titulares);
	});

	// CHARTS REQUESTS
	// CLIENT
	Route::post('/getChartPie/{id}/{type?}/{mes?}/{año?}', 'GraffController@getChartPie');
	Route::post('/getChartSerial/{id}/{type?}', 'GraffController@getChartSerial');

	// ENTERPRISE
	Route::post('/getChartPieEnt/{id}/{type?}/{mes?}/{año?}', 'GraffController@getChartPieEnt');
	Route::post('/getSerialChartEnt/{id}/{type?}', 'GraffController@getSerialChartEnt');


	// --------------------------------------------------------------------------------------------------------
	// CLIENTE
	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');
	Route::post('/telefonosServicios/{idCliente}/{fecha?}', 'GraffController@getChartBroke');

	Route::get('/test', function() {
		$b = array();
		$c = array();
		foreach ($telefonos = Cliente::find(7)->numeros as $key => $value) {
			$id     = $value->id;
			$numero = $value->numero;
			array_push($b, array(
				'type' => $numero,
			// 'percent' => $value->,
				'subs' => array(),
				));
			foreach (Telefono::find($id)->servicios as $key => $value) {
				$c = array_add($c, $key, array(
					'type' => $value->tipo,
					'percent' => $value->precio_servicio,
					));
			}
			array_push($b[$key]['subs'], $c);
		}
		Func::printr(json_encode($b));
	});

	Route::get('/user/message', function(){
		return View::make('message');
	});
});

Route::get('/question', function(){
	$preguntas  = Pregunta::where('estado','=','A')->get();
	return View::make('question')->with('preguntas', $preguntas);
});
Route::get('/user/question', function(){
	$preguntas  = Pregunta::where('estado','=','A')->get();
	return View::make('question2')->with('preguntas', $preguntas);
});
Route::post('/question', 'PreguntasController@recibe');