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

Route::get('/', function(){
	return View::make('index');
});

Route::get('formulario', function(){
    return View::make('formulario');
});

Route::get('/graf1', function () {
    Func::printr(Carbon::today()->subMonths(6)->month);
    // Func::printr(Cliente::productosPorMes('111-1', 7));
});

/**
 * ROUTES CHARTS
 */
Route::post('/getChartPie/{id}/{type}/{mes?}', 'GraffController@getChartPie');
Route::post('/getChartSerial/{id}/{type}', 'GraffController@getChartSerial');