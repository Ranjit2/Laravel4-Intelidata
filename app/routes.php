<?php

$idata = '';
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
Route::group(array('after' => 'auth'), function()use($idata) {
	// ROOT
	Route::get('', function() { return Redirect::to('login'); });

	// LOGIN
	Route::get('login', 'HomeController@showLogin');
	Route::post('login', 'HomeController@doLogin');

	// REGISTRO
	Route::get('registro', 'RegistroController@index');
	Route::post('registro', 'RegistroController@grabarRegistro');
});

// DESPUES DE AUTENTIFICARCE
Route::group(array('before' => 'auth'), function()use($idata){

	// ROOT
	Route::get('', function() { return Redirect::to('home'); });

	// HOME VIEW
	Route::get('home', 'HomeController@index');

	// LOGOUT
	Route::get('logout', 'HomeController@doLogout');

	// USER
	Route::group(array('prefix' => 'user'), function()use($idata) {
		Route::get('message', function() { return View::make('message'); });
		// Profile
		// primera vez llenado de perfil
		Route::post('profile2', 'PersonaController@ingreso');
		
		Route::get('profile', 'PersonaController@edit');
		Route::put('profile/{id}', 'PersonaController@update');
		// Contact questions
		Route::get('question', 'PreguntasController@index2');
		Route::post('question', 'PreguntasController@recibe');

	});

	// Contact init
	Route::get('question', 'PreguntasController@index');
	Route::post('question', 'PreguntasController@recibe');

	// CHARTS VIEWS
	Route::group(array('prefix' => 'charts'), function()use($idata){
		Route::get('pie', function() { return View::make('charts.pie.' . Session::get('ses_user_tipo')); });
		Route::get('column', function() { return View::make('charts.column.' . Session::get('ses_user_tipo')); });
		Route::get('stackbar', function() { return View::make('charts.stackbar.' . Session::get('ses_user_tipo')); });
		Route::get('breakchart', function() { return View::make('charts.break.' . Session::get('ses_user_tipo')); });
		Route::get('evolution', function() { return View::make('charts.line.' . Session::get('ses_user_tipo')); });
		Route::get('comparative', function() { return View::make('charts.comparative'); });

		Route::get('grafHistoricoCategoria', function(){return View::make('charts.pie.historicoCategoria'); });
		route::get('grafHistoricoMes', function(){return View::make('charts.column.historicoMesEmpresa'); });

		Route::get('telefonosPorProducto', function(){ return View::make('charts.pie.telefonosPorProducto')->with('types', Producto::lists('nombre', 'id')); });

	});


	// CHARTS REQUESTS
	// CLIENT
Route::post('postChartPie/{id}/{type?}/{date?}', 'GraffController@postChartPie');
Route::post('postChartSerial/{id}/{type?}', 'GraffController@postChartSerial');

	// ENTERPRISE
Route::post('postChartPieEnt/{id}/{type?}/{date?}', 'GraffController@postChartPieEnt');
Route::post('postSerialChartEnt/{id}/{type?}', 'GraffController@postSerialChartEnt');
Route::post('postChartComparative/{id}', 'GraffController@postChartComparative');
Route::post('postChartEvolution/{id}', 'GraffController@postChartEvolution');
Route::post('postTelefonosConServicios/{id}/{date?}', 'GraffController@postTelefonosConServicios');
Route::post('postTelefonosPorProducto/{id?}/{product?}/{date?}', 'GraffController@postTelefonosPorProducto');
Route::post('grafHistoricoCategoria/{id}/{date}', 'GraffController@postHistoricoCategoria');

Route::get('verClientes/{id}', 'GraffController@telefonosPorCliente');

	// TIMELINE
Route::get('timeline', 'TimelineController@index');
Route::post('timeline', 'TimelineController@index');

	// EXCEL
Route::get('telefonoMontos', 'TelefonoController@telefonoMontosTotales' );
	//Excel para graficos de columnas de empresas
Route::get('excelMontosDetalle/{id}/{date}/{mes}', 'TelefonoController@telefonosMontosDetalles');
	//Excel para grafico de columna de cliente persona
Route::get('excelTotales/{id}/{fecha?}', 'ClienteController@generaExcelTotales');
});
	//excel para Evolucion total mensual
Route::get('excelEvolucionTotalMensual/{id}', 'ClienteController@generaExcelEvolucionTotalMensual');
	//Excel para historico por categorias
Route::get('excelHistoricoCategoria/{id}/{fecha}/{mes}', 'ProductoController@generaExcelHistoricoCategoria');
	//Excel para historico por mes
Route::get('excelHistoricoCategoriaAnual/{id}', 'ProductoController@generaExcelHistoricoCategoriaAnual');
	//Excel para telefonos por productos
Route::get('generaExcelTelefonosPorProducto/{id}/{idProducto}/{date}', 'ProductoController@generaExcelTelefonosPorProducto');

Route::resource('nerds', 'PersonaController');
Route::resource('webservice', 'WebServiceController');



//Grafico historico categoria empresa
Route::post('grafHistoricoMes/{id}', 'GraffController@postHistoricoCategoria');

Route::get('prueba', function(){
	$fecha = Carbon::now()->subMonths(12)->startOfMonth();
	$data = array();
	$config = array();
	$productos = array();
	for($x = 0; $x <= 12; $x++)
	{
		$resultado = DB::table('cliente')
		->select('total.fecha','producto.nombre as producto', DB::raw('SUM(total.monto_total) as total'))
		->join('telefono', 'cliente.id', '=', 'telefono.id_cliente')
		->join('total', 'telefono.id', '=', 'total.id_telefono')
		->join('producto', 'producto.id','=','telefono.id_producto')
		->where('cliente.id','=',7)
		->where(DB::raw('MONTH(fecha)'), $fecha->month)
		->where(DB::raw('YEAR(fecha)'), $fecha->year)
		->groupBy('telefono.id_producto')
		->get();

		$objecto = new stdClass;
		$objecto->mes = (Func::convNumberToMonth($fecha->month).' '.$fecha->year);
		foreach ($resultado as $value) {
			$prod = $value->producto;
			$objecto->$prod = $value->total;
			$productos[] = $value->producto;
		}
		$data[] = $objecto;

		$fecha = $fecha->addMonth(1);
	}
	$productos = array_unique($productos);

	return Func::printr($data);
});

Route::get('test', function() {
	Cliente::postChartComparative(7);
});

Route::get('excel', function (){
	$data =  array('a'=>1000,'b'=>5000);
	Excel::create('TotalPorMes', function($excel)use($data)
	{
		$excel->sheet('sheet', function($sheet)use($data)
		{
			$sheet->fromArray($data);
		});
	})->export('xls');
});

Route::get('pdf', function(){
	// Locak
	$file = 'datos/cuenta.pdf';
	// Producción
	// $file = '../datos/cuenta.pdf';
	if(file_exists($file)) {
		$content = file_get_contents($file);
		return Response::make($content, 200, array('content-type'=>'application/pdf'));
	}
});

Route::post('edit-marks', 'HomeController@postEditMarks');



Route::get('majony', function(){



	$tieneTwitter  = filter_var(ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'twitter'), FILTER_VALIDATE_BOOLEAN);
	$tieneFacebook = filter_var(ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'facebook'), FILTER_VALIDATE_BOOLEAN);
	$tieneSkype    = filter_var(ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'skype'), FILTER_VALIDATE_BOOLEAN);

	// var_dump(ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'facebook'));
	// return;



	if( ($tieneTwitter) || ($tieneFacebook) || ($tieneSkype) )
	{
		return "tyiene una red solcial";
	}
	else
	{
		return "no tiene redes sociales";
	}
});