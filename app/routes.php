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
Route::pattern('date', '^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$');

// ANTES O SIN AUTENTIFICARCE
Route::group(array('after' => 'auth'), function() {
	// ROOT
	Route::get('/', function() { return Redirect::to('/login'); });

	// LOGIN
	Route::get('/login', 'HomeController@showLogin');
	Route::post('/login', 'HomeController@doLogin');

	// REGISTRO
	Route::get('/registro', function() { return View::make('registro'); });
	Route::post('/registro', 'registroController@grabarRegistro' );
});

// DESPUES DE AUTENTIFICARCE
Route::group(array('before' => 'auth'), function() {

	// ROOT
	Route::get('/', function() { return Redirect::to('/home'); });

	// LOGOUT
	Route::get('/logout', 'HomeController@doLogout');

	// USER
	Route::get('/user/message', function() { return View::make('message'); });
	Route::get('/user/profile', 'PersonaController@edit');
	Route::put('/user/profile/{id}', 'PersonaController@update');

	// HOME VIEW
	Route::get('/home', function() {
		if(count(Pregunta::scopeWhereNot(Session::get('ses_user_id'))) == 0) {
			return View::make('home');
		} else {
			return Redirect::to('/question');
		}
	});

	Route::get('/user/question', function() { return View::make('question2')->with('preguntas', Pregunta::where('estado', 'A')->get()); });
	Route::post('/user/question', 'PreguntasController@recibe');

	// CONTACT QUESTIONS
	Route::get('/question', function() {
		$preguntas = Pregunta::scopeWhereNot(Session::get('ses_user_id'));
		return View::make('perfil')->with('preguntas', $preguntas);
	});
	Route::post('/question', 'PreguntasController@recibe');

	// CHARTS VIEWS
	Route::get('/charts/pie', function() { return View::make('charts.pie.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/column', function() { return View::make('charts.column.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/stackbar', function() { return View::make('charts.stackbar.' . Session::get('ses_user_tipo')); });
	Route::get('/charts/breakchart', function() {
		$titulares = Titular::select('tipo')->get();
		return View::make('charts.break.' . Session::get('ses_user_tipo'))->with('titulares', $titulares);
	});
	Route::get('/charts/evolution', function() {
		$count = 1;
		$data = array();
		$years = array(
			Carbon::now()->subYears(2)->year,
			Carbon::now()->subYears(1)->year,
			Carbon::now()->year,
			);
		$ids = Cliente::find(7)->numeros()->lists('id');
		for ($i = 0; $i < 12; $i++) {
			array_push($data, array(
				'date' => Func::convNumberToMonth($count++),
				'year1' => $years[0],
				'year2' => $years[1],
				'year3' => $years[2],
				));
			$query = Total::select(DB::raw('YEAR(fecha) AS year, SUM(monto_total) AS monto_total'))
			->whereIn('id_telefono', $ids)
			->whereIn(DB::raw('YEAR(fecha)'), $years)
			->where(DB::raw('MONTH(fecha)'), $i)
			->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
			->orderBy('fecha')
			->get();

			foreach ($query as $value) {
				switch ($value->year) {
					case $years[0]:
					$data[$i] = array_add($data[$i], 'val1', $value->monto_total);
					break;

					case $years[1]:
					$data[$i] = array_add($data[$i], 'val2', $value->monto_total);
					break;

					case $years[2]:
					$data[$i] = array_add($data[$i], 'val3', $value->monto_total);
					break;

					default:
					break;
				}
			}
		}
		return View::make('evolution')->with('data', json_encode($data))->with('year', $years);
	});

	// CHARTS REQUESTS
	// CLIENT
Route::post('/getChartPie/{id}/{type?}/{date?}', 'GraffController@getChartPie');
Route::post('/getChartSerial/{id}/{type?}', 'GraffController@getChartSerial');

	// ENTERPRISE
Route::post('/getChartPieEnt/{id}/{type?}/{date?}', 'GraffController@getChartPieEnt');
Route::post('/getSerialChartEnt/{id}/{type?}', 'GraffController@getSerialChartEnt');
Route::post('/telefonosServicios/{id}/{date?}', 'GraffController@getChartBroke');

Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');

	// TIMELINE
Route::get('timeline', 'TimelineController@index');
Route::post('timeline', 'TimelineController@index');

Route::get('/charts/line', function() {
	$data = Cliente::evolutionChart(Session::get('ses_user_id'));
	return View::make('charts.line.' . Session::get('ses_user_tipo'))->with('data', json_encode($data));
});
});

Route::resource('nerds', 'PersonaController');

Route::get('test', function(){
	Cliente::evolutionChart(7);
	return View::make('charts.line.empresa');
});

Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );