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
		$rules = array(
			'username'    => 'required',
			'password' => 'required|alphaNum|min:3'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password'),
				);

			if (Auth::attempt($userdata)) {
				return Redirect::to('formulario');
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
		return Redirect::to('login');
	}
}