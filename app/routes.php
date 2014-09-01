<?php

q/*
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
		Route::get('/breakchart', function() {
			$titulares = Titular::select('tipo')->get();
			return View::make('charts.break.' . Session::get('ses_user_tipo'))->with('titulares', $titulares);
		});
		Route::get('/evolution', 'GraffController@getChartEvolution');
		Route::get('/line', function() {
			$data = Cliente::evolutionChart(Session::get('ses_user_id'));
			return View::make('charts.line.' . Session::get('ses_user_tipo'))->with('data', json_encode($data));
		});
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

	// EXCEL
	Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );
	Route::get('excelMontosDetalle/{id}/{date}/{mes}', 'TelefonoController@telefonosMontosDetalles');
});

Route::resource('nerds', 'PersonaController');
<<<<<<< HEAD

Route::get('test', function(){
	SoapWrapper::add(function ($service) {
		$service->name('weather')->wsdl('http://www.webservicex.net/globalweather.asmx?WSDL');
	});

	$data = array(
		'CountryName' => 'Chile',
		'CityName'    => 'Santiago',
		);
	$func       = 'GetWeather';
	$funcResult = $func . 'Result';
	// $data       = Func::arrayToXML($data);

	$result = SoapWrapper::service('weather', function($service) use ($data, $func, $funcResult) {
		// var_dump($service->getFunctions());
		return $service->call($func, $data)->$funcResult;
	});
	Func::printr($result);

	die();

	Cliente::evolutionChart(7);
	return View::make('charts.line.empresa');
});

Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );

//Excel para graficos de columnas de empresas
Route::get('excelMontosDetalle/{id}/{date}/{mes}', 'TelefonoController@telefonosMontosDetalles');

//excel para grafico de columna de cliente persona
Route::get('excelTotales/{id}/{fecha?}', 'ClienteController@generaExcelTotales');


Route::get('prueba', function(){
		/*
select t.id_producto, sum(tot.monto_total)  
from cliente c,
     telefono t,
     total tot
where c.id = t.id_cliente and
      tot.id_telefono = t.id and
      c.id = 7 and
      MONTH(tot.fecha) = 5 and
      YEAR(tot.fecha) = 2014
group by(t.id_producto)
	*/

	$telefonos_id  = array();
	$fecha    = new Carbon('2014-05-01');
	$variable = Cliente::find(7)->categorias;
	foreach ($variable as $value) {
		$telefonos_id[] = $value->id;
	}

	return Total::whereIn('id_telefono', $telefonos_id)->where(DB::raw('MONTH(fecha)'), $fecha->month)->where(DB::raw('YEAR(fecha)'), $fecha->year)->get();





	return Total::whereIn('id_telefono', $telefonos_id)->where(DB::raw('MONTH(fecha)'), $fecha->month)->where(DB::raw('YEAR(fecha)'), $fecha->year)->get();

	DB::table('name')->sum('column');


	$variable = Cliente::find(7)->categorias;
	foreach ($variable as $value) {
		$variable2 = Total::whereIdTelefono($value->id)->where(DB::raw('MONTH(fecha)'), $fecha->month)->where(DB::raw('YEAR(fecha)'), $fecha->year)->first();
		$producto = new stdClass;
		$producto->nombre = $value->id_producto;
		$producto->total  = $variable2->monto_total;
		array_push($arreglo, $producto);
		// $producto->total

		// foreach ($variable2 as $value2) {
		// 	var_dump($value2);
		// };
	};
	return $arreglo;
});





// Route::get('insertando', function(){
// 	$fecha = new Carbon('2013-05-01');
// 	$contador = 0;
// 	$aumento  = 0;
// 	$arreglo = array();
// 	for($x = 0; $x < 17; $x++) 
// 	{
// 		for($y = 37; $y <= 41; $y++)
// 		{
// 			$total = new Total;
// 			$total->fecha = $fecha->toDateTimeString();
// 			$total->id_telefono = $y;
// 			$total->monto_total = 4000 + $aumento;
// 			$aumento = $aumento + 1100;
// 			$arreglo[$contador] = $total;
// 			//$total->save();
// 			$contador++;
// 		}
// 		$fecha = $fecha->addMonths(1);
// 	}
// 	return 'done';
// });


// Route::get('insertando', function(){
// 	$arreglo = array();

// 	for($tel = 1; $tel <= 9; $tel++)
// 	{
// 		if($tel == 1)
// 			$lucas = 50000;
// 		if($tel == 2)
// 			$lucas = 60000;
// 		if($tel == 3)
// 			$lucas = 70000;
// 		if($tel == 4)
// 			$lucas = 80000;
// 		if($tel == 5)
// 			$lucas = 90000;
// 		if($tel == 6)
// 			$lucas = 100000;
// 		if($tel == 7)
// 			$lucas = 110000;
// 		if($tel == 8)
// 			$lucas = 120000;
// 		if($tel == 9)
// 			$lucas = 130000;

// 		for($serv = 1; $serv <= 5; $serv++)
// 		{
// 			$ts = new TelefonoServicio;
// 			$ts->id_telefono = $tel; //telefono
// 			$ts->id_servicio = $serv; //servicio 1 al 5
// 			if($serv == 5)
// 			{
// 				$ts->precio_servicio = -20000; //precio del servicio
// 			}
// 			else
// 			{
// 				$ts->precio_servicio = $lucas; //precio del servicio
// 			}
// 			$ts->fecha = '2014-09-01';
// 			array_push($arreglo, $ts);
// 			$lucas = $lucas + 10000;
// 			$ts->save();
// 		}
// 	}
// 	return $arreglo;
// });
=======
Route::resource('webservice', 'WebServiceController');
>>>>>>> origin/dev
