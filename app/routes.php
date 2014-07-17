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
        return Input::get("name") . Input::get("age");
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
    return "<h1>Welcome Charts...</h1>";
});

Route::get('formulario', function(){
    Excel::load('datos/datos.csv', function($reader) {
    
        $reader->dump();        
    
    }, 'ISO-8859-1');
    return Response::view("formulario");
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
    return "Ok";
});


