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
Route::pattern('date', '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/');

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

	// USER
	Route::get('/user/message', function(){ return View::make('message'); });
	Route::get('/user/profile', 'PersonaController@edit');
	// Route::post('/user/profile/{id}', 'PersonaController@update');
	Route::put('/user/profile/{id}', 'PersonaController@update');

	// HOME VIEW
	Route::get('/home', function() {
		if(count(Pregunta::scopeWhereNot(Session::get('ses_user_id'))) == 0) {
			return View::make('home');
		} else {
			return Redirect::to('/question');
		}
	});

	Route::get('/user/question', function(){ return View::make('question2')->with('preguntas', Pregunta::where('estado', 'A')->get()); });
	Route::post('/user/question', 'PreguntasController@recibe');

	// CONTACT QUESTIONS
	Route::get('/question', function(){
		$preguntas = Pregunta::scopeWhereNot(Session::get('ses_user_id'));
		return View::make('perfil')->with('preguntas', $preguntas);
	});
	Route::post('/question', 'PreguntasController@recibe');

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
	Route::post('/getChartPieEnt/{id}/{type?}/{date?}', 'GraffController@getChartPieEnt');
	Route::post('/getSerialChartEnt/{id}/{type?}', 'GraffController@getSerialChartEnt');
	Route::get('/charts/evolution', function(){ return View::make('evolution'); });

	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');
	Route::post('/telefonosServicios/{idCliente}/{date?}', 'GraffController@getChartBroke');

	// TIMELINE
	Route::get('timeline', 'TimelineController@index');
	Route::post('timeline', 'TimelineController@index');

	// Route::get('/test', function() {
		// $b = array();
		// $c = array();
		// foreach ($telefonos = Cliente::find(7)->numeros as $key => $value) {
		// 	$id     = $value->id;
		// 	$numero = $value->numero;
		// 	array_push($b, array(
		// 		'type' => $numero,
		// 	// 'percent' => $value->,
		// 		'subs' => array(),
		// 		));
		// 	foreach (Telefono::find($id)->servicios as $key => $value) {
		// 		$c = array_add($c, $key, array(
		// 			'type' => $value->tipo,
		// 			'percent' => $value->precio_servicio,
		// 			));
		// 	}
		// 	array_push($b[$key]['subs'], $c);
		// }
		// Func::printr(json_encode($b));

	// });
});

Route::get('registro', function(){
	return View::make('registro');
});

Route::post('registro', 'registroController@grabarRegistro' );


Route::get('majony', function(){
	var_dump(Rut::validate('15326912-5'));
	var_dump(Rut::validate('15326912-2'));
	var_dump(Rut::validate('15326912'));
	var_dump(Rut::format('6-008.261-1'));
	return "";
});

Route::resource('nerds', 'PersonaController');

Route::get('test', function(){
	return Cliente::find(Session::get('ses_user_id'))->persona;
});
