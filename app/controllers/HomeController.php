<?php

class HomeController extends BaseController {

	/**
	 * [showLogin description]
	 * @return [type] [description]
	 */
	public function showLogin() {
		return View::make('index');
	}

	/**
	 * [doLogin description]
	 * @return [type] [description]
	 */
	public function doLogin() {

		Config::set('auth.username', 'rut');
		Config::set('auth.password', 'clave');

		$rules = array(
			'rut'      => 'required',
			'password' => 'required|alpha_dash|min:3'
			);

		$messages = array(
			'rut.required'      => 'RUT requerido.',
			'password.required' => 'Contraseña requerida.'
			);

		$validator = Validator::make(Input::all(), $rules, $messages);

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
					return Redirect::to('formulario');
				}
			} else {
				return Redirect::to('login');
			}
		}
	}

	/**
	 * [doLogout description]
	 * @return [type] [description]
	 */
	public function doLogout() {
		Auth::logout();
		Session::forget('ses_user_id');
		Session::forget('ses_user_rut');
		return Redirect::to('login');
	}


}