<?php

class PersonaController extends BaseController {

	/**
	* Display a listing of the resource.
	* GET /persona
	*
	* @return Response
	*/
	public function index()
	{
		$nerds = Persona::all();
		return View::make('nerds.index')->with('nerds', $nerds);
	}

	/**
	* Show the form for creating a new resource.
	* GET /persona/create
	*
	* @return Response
	*/
	public function create()
	{
		return View::make('nerds.create');
	}

	/**
	* Store a newly created resource in storage.
	* POST /persona
	*
	* @return Response
	*/
	public function store()
	{
		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email',
			'nerd_level' => 'required|numeric'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('nerds/create')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$nerd = new Nerd;
			$nerd->name       = Input::get('name');
			$nerd->email      = Input::get('email');
			$nerd->nerd_level = Input::get('nerd_level');
			$nerd->save();

			Session::flash('message', 'Successfully created nerd!');
			return Redirect::to('nerds');
		}

	}

	/**
	* Display the specified resource.
	* GET /persona/{id}
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($id)
	{
		$nerd = Persona::find($id);
		return View::make('nerds.show')->with('nerd', $nerd);
	}

	/**
	* Show the form for editing the specified resource.
	* GET /persona/{id}/edit
	*
	* @return Response
	*/
	public function edit()
	{
		$persona = Cliente::find(Session::get('ses_user_id'))->persona;
		return View::make('users.profile')->with('persona', $persona);
	}

	/**
	* Update the specified resource in storage.
	* PUT /persona/{id}
	*
	* @param  int  $id
	* @return Response
	*/
	public function update($id)
	{
		dd($id);
		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email',
			'nerd_level' => 'required|numeric'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('nerds/' . $id . '/edit')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$nerd = Persona::find($id);
			$nerd->name       = Input::get('name');
			$nerd->email      = Input::get('email');
			$nerd->nerd_level = Input::get('nerd_level');
			$nerd->save();

			Session::flash('message', 'Successfully updated nerd!');
			return Redirect::to('nerds');
		}
	}

	/**
	* Remove the specified resource from storage.
	* DELETE /persona/{id}
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id)
	{
		$nerd = Persona::find($id);
		$nerd->delete();

		Session::flash('message', 'Successfully deleted the nerd!');
		return Redirect::to('nerds');
	}

}