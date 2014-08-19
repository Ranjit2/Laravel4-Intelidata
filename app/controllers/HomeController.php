<?php

class HomeController extends BaseController {

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
				if (Auth::check())
				{
					Session::put('ses_user_id', Auth::user()->getId());
					Session::put('ses_user_rut', Auth::user()->rut);
					Session::put('ses_user_tipo', Auth::user()->tipo);
					return Redirect::to('/home');
				}
			} else {
				return Redirect::to('/login');
			}
		}
	}

	public function doLogout() {
		Auth::logout();
		Session::forget('ses_user_id');
		Session::forget('ses_user_rut');
		Session::forget('ses_user_tipo');
		return Redirect::to('login');
	}

}