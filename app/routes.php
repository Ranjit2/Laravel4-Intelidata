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

Route::get('/get', function(){
    if(Request::ajax()) {
        return View::make('prueba');
    }
});

Route::post('/get2', function(){
    if(Request::ajax()) {
        return Input::get('name') . Input::get('age');
    }
});

Route::post('/get', 'BaseController@index');

Route::post('submit', function(){
    $validator = Validator::make(array('name' => Input::get('name')), array('name' => 'required|min:1|max:5|alpha'));
    if ($validator->fails()) {
        return Response::json(array('success' => false,'errors' => $validator->errors()->toArray()));
    }
    return Response::json(array('success' => true));
});

Route::get('/mail', function(){
    if(Request::ajax()) {
        $data = ['title' => 'Welcome to Wsnippets!'];
        Mail::send('hello', $data, function($message){
            $message->to('mail@gmail.com', 'Tester')->cc('mail@gmail.com')->subject('Email Testing');
        });
        usleep(200000);
        return Response::json(array('message' => 'Sending'));
    }
    return Response::json(array('message' => 'Error!'));
});

Route::get('/chart', function(){
    return '<h1>Welcome Charts...</h1>';
});

Route::post('envioForm',function(){
    $validator = Validator::make(
        array('username' => Input::get('username'), 'password' => Input::get('password'), 'email' => Input::get('email')),
        array('username' => 'required', 'password' => 'required|min:5','email' => 'required|email')
        );
    if ($validator->fails())
    {
        return Redirect::to('formulario')->withErrors($validator)->withInput();
    }
    return 'Ok';
});

Route::get('formulario', function(){
    // Convierte el mes del archivo a importar a numero
    // $res = Excel::load('datos/datos.csv', 'ISO-8859-1')->toArray();
    // $graff = new Grafico;
    // foreach($res as $sheet)
    // {
    //     $month = Func::convMonthToNumber(array_get($sheet, 'mes'));
    //     $graff->empresa   = array_get($sheet, 'empresa', '');
    //     $graff->año       = array_get($sheet, 'año', '');
    //     $graff->mes       = $month;
    //     $graff->categoria = array_get($sheet, 'categoria', '');
    //     $graff->save();
    //     Debugbar::info($res);
    // }

    // foreach (Grafico::groupBy('mes')->get() as $value) {
    //     // Debugbar::info($value);
    //     $labels[] = $value->mes;
    // }

    // $histo = Grafico::historicChart();
    // $donut = Grafico::donut_valueByProduct('Entel', 'mes', 2014);

    // Debugbar::info($histo);

    // Debugbar::info();

    return View::make('formulario');
});

Route::get('/graf1', function () {
    return Grafico::graf1();
});

Route::post('/graffs', function() {
    $type = array('serial', 'pie');
    // Debugbar::info($type[0]);

    $ejeY = 'year';

    $data = array(
        array(
            'year'     => 2004,
            'europe'   => 3.54,
            'namerica' => 1.78,
            'asia'     => 2.5,
            'lamerica' => 0.3,
            'meast'    => 9.2,
            'africa'   => 8.1
        ),
        array(
            'year'     => 2003,
            'europe'   => 2.5,
            'namerica' => 2.5,
            'asia'     => 2.1,
            'lamerica' => 0.3,
            'meast'    => 0.2,
            'africa'   => 0.1
        ),
    );

    $graphs = array(
        'balloonText' => e('<b>[[title]]</b><br><span style="font-size: 4px">[[category]] => <b>[[value]]</b></span>'),
        'labelText'   => '[[title]] [[value]]',
        'fillAlphas'  => 0.8,
        'lineAlpha'   => 0.2,
        'color'       => '#000000',
        'title'       => 'Europe',
        'type'        => 'column',
        'valueField'  => 'europe',
    );

    $serial = array(
        'type'   => $type[1],
        'theme'  => 'none',
        'legend' => array(
            'horizontalGap'    => 10,
            'maxColumns'       => 1,
            'position'         => 'bottom',
            'useGraphSettings' => true,
            'markerSize'       => 10,
        ),
        'dataProvider' => $data,
        'valueAxes'    => array(
            'stackType'  => 'regular',
            'axisAlpha'  => 0.3,
            'gridAlpha'  => 0.2,
            'gridColor'  => '#FFFFFF',
            'dashLength' =>  0
        ),
        'graphs'        => $graphs,
        'categoryField' => $ejeY,
        'categoryAxis'  => array(
            'gridPosition' => 'start',
            'axisAlpha'    => 0,
            'gridAlpha'    => 0,
            'position'     => 'left',
        ),
        'pathToImages' => 'http://cdn.amcharts.com/lib/3/images/',
        // 'gridAboveGraphs': true,
        // 'startDuration': 1,
        'exportConfig' => array(
            'menuTop'   => '20px',
            'menuRight' => '20px',
            'menuItems' =>  array(
                'icon'   =>  'http => //www.amcharts.com/lib/3/images/export.png',
                'format' =>  'png'
            )
        ),

    );

    $pie = array(
        'type'         => 'pie',
        'theme'        => 'none',
        'dataProvider' => $data,
        'titleField'   => 'year',
        'valueField'   => 'europe',
        'labelRadius'  => 5,

        'radius'       => '42%',
        'innerRadius'  => '60%',
        'labelText'    => '[[title]]'
    );
    Debugbar::info(json_encode($serial));
    return Response::json($serial);
     // return json_encode($var);
});

Route::post('/graffs/{id}', 'GraffController@devuelveCategoria');