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
	Route::get('/registro', 'RegistroController@index');
	Route::post('/registro', 'RegistroController@grabarRegistro');
});

// DESPUES DE AUTENTIFICARCE
Route::group(array('before' => 'auth'), function() {

	// ROOT
	Route::get('/', function() { return Redirect::to('/home'); });

	// HOME VIEW
	Route::get('/home', 'HomeController@index');

	// LOGOUT
	Route::get('/logout', 'HomeController@doLogout');

	// USER
	Route::group(array('prefix' => '/user'), function() {
		Route::get('/message', function() { return View::make('message'); });
		// Profile
		Route::get('/profile', 'PersonaController@edit');
		Route::put('/profile/{id}', 'PersonaController@update');
		// Contact questions
		Route::get('/question', 'PreguntasController@index2');
		Route::post('/question', 'PreguntasController@recibe');
	});

	// Contact init
	Route::get('/question', 'PreguntasController@index');
	Route::post('/question', 'PreguntasController@recibe');

	// CHARTS VIEWS
	Route::group(array('prefix' => '/charts'), function() {
		Route::get('/pie', function() { return View::make('charts.pie.' . Session::get('ses_user_tipo')); });
		Route::get('/column', function() { return View::make('charts.column.' . Session::get('ses_user_tipo')); });
		Route::get('/stackbar', function() { return View::make('charts.stackbar.' . Session::get('ses_user_tipo')); });
		Route::get('/breakchart', function() { return View::make('charts.break.' . Session::get('ses_user_tipo')); });
		Route::get('/evolution', function() { return View::make('charts.line.' . Session::get('ses_user_tipo')); });
		Route::get('/comparative', function() { return View::make('charts.comparative'); });
		Route::get('/grafHistoricoCategoria', function(){ return View::make('charts.pie.historicoCategoria'); });
		Route::get('/telefonosPorProducto', function(){ return View::make('charts.pie.telefonosPorProducto')->with('types', Producto::lists('nombre', 'id')); });
	});


	// CHARTS REQUESTS
	// CLIENT
	Route::post('/postChartPie/{id}/{type?}/{date?}', 'GraffController@postChartPie');
	Route::post('/postChartSerial/{id}/{type?}', 'GraffController@postChartSerial');

	// ENTERPRISE
	Route::post('/postChartPieEnt/{id}/{type?}/{date?}', 'GraffController@postChartPieEnt');
	Route::post('/postSerialChartEnt/{id}/{type?}', 'GraffController@postSerialChartEnt');
	Route::post('/postChartComparative/{id}', 'GraffController@postChartComparative');
	Route::post('/postChartEvolution/{id}', 'GraffController@postChartEvolution');
	Route::post('/postTelefonosConServicios/{id}/{date?}', 'GraffController@postTelefonosConServicios');
	Route::post('/postTelefonosPorProducto/{id?}/{product?}/{date?}', 'GraffController@postTelefonosPorProducto');

	Route::get('/verClientes/{id}', 'GraffController@telefonosPorCliente');

	// TIMELINE
	Route::get('/timeline', 'TimelineController@index');
	Route::post('/timeline', 'TimelineController@index');

	// EXCEL
	Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );
	//Excel para graficos de columnas de empresas
	Route::get('excelMontosDetalle/{id}/{date}/{mes}', 'TelefonoController@telefonosMontosDetalles');
	//Excel para grafico de columna de cliente persona
	Route::get('excelTotales/{id}/{fecha?}', 'ClienteController@generaExcelTotales');
});

Route::resource('nerds', 'PersonaController');
Route::resource('webservice', 'WebServiceController');

Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );

//Excel para graficos de columnas de empresas
Route::get('excelMontosDetalle/{id}/{date}/{mes}', 'TelefonoController@telefonosMontosDetalles');

//excel para grafico de columna de cliente persona
Route::get('excelTotales/{id}/{fecha?}', 'ClienteController@generaExcelTotales');

//Grafico historico categoria empresa
// Route::post('/historicoCategoria/{id}/{date}', function(){
// 	$fecha    = new Carbon('2014-09-01');
// 	$resultado = DB::table('cliente')
// 				->select('producto.nombre', DB::raw('SUM(total.monto_total) as cantidad'))
//                 ->join('telefono', 'cliente.id', '=', 'telefono.id_cliente')
//                 ->join('total', 'telefono.id', '=', 'total.id_telefono')
//                 ->join('producto', 'producto.id','=','telefono.id_producto')
//                 ->where('cliente.id','=',7)
//                 ->where(DB::raw('MONTH(fecha)'), $fecha->month)
//                 ->where(DB::raw('YEAR(fecha)'), $fecha->year)
//                 ->groupBy('telefono.id_producto')
//                 ->get();
//     return $resultado;
// });
Route::post('/grafHistoricoCategoria/{id}/{date}', 'GraffController@postHistoricoCategoria');

//Grafico historico categoria empresa


Route::get('test', function() {
	Producto::postTelefonosPorProducto(7,1,'2014-09-01');
});