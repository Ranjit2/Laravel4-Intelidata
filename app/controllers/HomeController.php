<?php

class HomeController extends BaseController {

	public function index() {
		if(count(Pregunta::scopeWhereNot(Session::get('ses_user_id'))) == 0) {
			return View::make('home');
		} else {
			return Redirect::to('/question');
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
}