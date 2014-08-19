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
Route::group(array('after' => 'auth'), function() {
	// ROOT
	Route::get('/', function() { return Redirect::to('/login'); });

	// LOGIN
	Route::get('/login', 'HomeController@showLogin');
	Route::post('/login', 'HomeController@doLogin');
	// Route::get('/question', function(){
	// 	$preguntas  = Pregunta::where('estado','=','A')->get();
	// 	return View::make('question')->with('preguntas', $preguntas);
	// });
	// Route::get('/user/question', function(){
	// 	$preguntas  = Pregunta::where('estado','=','A')->get();
	// 	return View::make('question2')->with('preguntas', $preguntas);
	// });
	Route::get('/question', function(){
		$preguntas  = Pregunta::where('estado','=','A')->get();
		return View::make('perfil')->with('preguntas', $preguntas);
	});
	Route::post('/question', 'PreguntasController@recibe');
});

// DESPUES DE AUTENTIFICARCE
Route::group(array('before' => 'auth'), function() {

	// ROOT
	Route::get('/', function() { return Redirect::to('/home'); });

	// LOGOUT
	Route::get('/logout', 'HomeController@doLogout');

	// PROFILE
	Route::get('/user/profile', function() { return View::make('users.profile'); });
	Route::get('/user/message', function(){ return View::make('message'); });

	// HOME VIEW
<<<<<<< HEAD
	Route::get('/home', function() {
		if(Func::clienteRespondioEncuesta(Session::get('ses_user_id')))
		{
			$f = Telefono::fechas_importantes();
			return View::make('home')->with('tline', $f);
		}
		else
		{
			return Redirect::to('/question');	
		}
	});

=======
	Route::get('/home', function() { return View::make('home'); });
>>>>>>> 71c05be6515d5a970f011e885afb687b4ca15d39

	// CHARTS VIEWS
	Route::get('/charts/pie', function(){ return View::make('charts.pie.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/column', function(){ return View::make('charts.column.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/stackbar', function(){ return View::make('charts.stackbar.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/breakchart', function(){
		$titulares = Titular::select('tipo')->get();
		return View::make('charts.break.' . Session::get('ses_user_tipo'))->with('titulares', $titulares);
	});

	// CHARTS REQUESTS
	// CLIENT
	Route::post('/getChartPie/{id}/{type?}/{mes?}', 'GraffController@getChartPie');
	Route::post('/getChartSerial/{id}/{type?}', 'GraffController@getChartSerial');

	// ENTERPRISE
	Route::post('/getChartPieEnt/{id}/{type?}/{fecha?}', 'GraffController@getChartPieEnt');
	Route::post('/getSerialChartEnt/{id}/{type?}', 'GraffController@getSerialChartEnt');
	Route::get('/charts/evolution', function(){ return View::make('evolution'); });

	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');
	Route::post('/telefonosServicios/{idCliente}/{fecha?}', 'GraffController@getChartBroke');

<<<<<<< HEAD
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

});


Route::post('/question', 'PreguntasController@recibe');
Route::get('timeline', function(){ return View::make('timeline'); });
Route::get('/charts/evolution', function(){ return View::make('evolution'); });



=======
	// TIMELINE
	Route::get('timeline', 'TimelineController@index');
	Route::post('timeline', 'TimelineController@index');

	// Route::get('/test', function() {
	// 	$b = array();
	// 	$c = array();
	// 	foreach ($telefonos = Cliente::find(7)->numeros as $key => $value) {
	// 		$id     = $value->id;
	// 		$numero = $value->numero;
	// 		array_push($b, array(
	// 			'type' => $numero,
	// 		// 'percent' => $value->,
	// 			'subs' => array(),
	// 			));
	// 		foreach (Telefono::find($id)->servicios as $key => $value) {
	// 			$c = array_add($c, $key, array(
	// 				'type' => $value->tipo,
	// 				'percent' => $value->precio_servicio,
	// 				));
	// 		}
	// 		array_push($b[$key]['subs'], $c);
	// 	}
	// 	Func::printr(json_encode($b));
	// });
});
>>>>>>> 71c05be6515d5a970f011e885afb687b4ca15d39
