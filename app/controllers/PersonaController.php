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
		$rules = array(
			'direccion_personal'     => '',
			'telefono_fijo_personal' => '',
			'celular_personal'       => '',
			'email_personal'         => 'email',
			// 'direccion_work'         => '',
			// 'telefono_fijo_work'     => '',
			// 'celular_work'           => '',
			// 'email_work'             => 'email',
			'twitter'                => '',
			'facebook'               => '',
			'skype'                  => '',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/user/profile')->withErrors($validator)->withInput();
		} else {
			$perso = Persona::find($id);
			$perso->direccion_personal     = Input::get('direccion_personal');
			$perso->telefono_fijo_personal = Input::get('telefono_fijo_personal');
			$perso->celular_personal       = Input::get('celular_personal');
			$perso->email_personal         = Input::get('email_personal');
			// $perso->direccion_work         = Input::get('direccion_work');
			// $perso->telefono_fijo_work     = Input::get('telefono_fijo_work');
			// $perso->celular_work           = Input::get('celular_work');
			// $perso->email_work             = Input::get('email_work');
			$perso->twitter                = Input::get('twitter');
			$perso->facebook               = Input::get('facebook');
			$perso->skype                  = Input::get('skype');
			$perso->save();

			Session::flash('message', 'Successfully updated nerd!');
			return Redirect::to('/user/profile');
		}
	}

	public function ingreso()
	{
		$rules = array(
			'direccion_personal'     => '',
			'telefono_fijo_personal' => '',
			'celular_personal'       => '',
			'email_personal'         => 'email',
			'twitter'                => '',
			'facebook'               => '',
			'skype'                  => '',
			);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/user/profile2')->withErrors($validator)->withInput();
		} else {
			
			//se ingresa nuevos datos de persona para el cliente
			$persona                         = new Persona;
			$persona->direccion_personal     = Input::get('direccion_personal');
			$persona->telefono_fijo_personal = Input::get('telefono_fijo_personal');
			$persona->celular_personal       = Input::get('celular_personal');
			$persona->email_personal         = Input::get('email_personal');
			$persona->twitter                = Input::get('twitter');
			$persona->facebook               = Input::get('facebook');
			$persona->skype                  = Input::get('skype');
			$persona->save();
			$insertedId = $persona->id;

			//se actualiza la tabla de cliente con el password recien ingresado
			$clienteU 	          = Cliente::find(Session::get('ses_user_id'));
			$clienteU->persona_id = $insertedId;
			$clienteU->save();

			//Session::flash('message', 'Successfully updated nerd!');
			//verificar aca si tiene preguntas pendientes si es asi enviar a responder preguntas sino al home
			if(count(Pregunta::scopeWhereNot(Session::get('ses_user_id'))) == 0) {
				return View::make('home');
			} 
			else 
			{
				return Redirect::to('/question');
			}
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