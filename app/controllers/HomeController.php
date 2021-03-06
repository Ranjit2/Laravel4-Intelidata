<?php

class HomeController extends BaseController {

	public function index() {
		if(ClienteController::estaRegistrado(Session::get('ses_user_id')))
		{
			//return Cliente::find(7)->persona;
			if(count(Pregunta::scopeWhereNot(Session::get('ses_user_id'))) == 0) {
				return View::make('home');
			} else {
				return Redirect::to('/question');
			}
		}
		else
		{
			//return "no esta registrado";
			return View::make('users.profile2');
			//return Redirect::to('user/profile');
		}
	}

	public function showLogin() {
		return View::make('index');
	}

	public function doLogin() {

		Config::set('auth.username', 'rut');
		Config::set('auth.password', 'clave');

		$rules = array(
			'rut'      => 'required',
			'password' => 'required|alpha_dash|min:3'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'rut'      => (string) Input::get('rut'),
				'password' => (string) Input::get('password'),
				);
			if (Auth::attempt($userdata)) {
				if (Auth::check()) {
					Event::fire('laravel.auth: login', array(Auth::user()));
					return Redirect::to('/home');
				}
			} else {
				return Redirect::to('/login');
			}
		}
	}

	public function doLogout() {
		Event::fire('laravel.auth: logout', array(Auth::user()));
		Auth::logout();
		return Redirect::to('login');
	}

	public function postEditMarks() {
		// dd(Input::all());
		$studentId = Input::get('pk');
		$newMarks = Input::get('value');
		$studentData = Persona::whereId($studentId)->first();
		$studentData->nombre = $newMarks;
		if($studentData->save())
			return Response::json(array('status'=>1));
		else
			return Response::json(array('status'=>0));
	}
}