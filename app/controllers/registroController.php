<?php

class RegistroController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /registro
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('registro');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /registro/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /registro
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /registro/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /registro/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /registro/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /registro/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public static function existeCliente($rut)
	{
		$variable = Cliente::whereRut($rut)->get();
		foreach ($variable as $value)
		{
			return true;
		}
		return false;
	}

	public static function getIdCliente($rut)
	{
		return Cliente::whereRut($rut)->select('id')->get()[0]['id'];
	}

	public static function grabarRegistro()
	{
		$variable = Input::all();
		$rules = array(
            'nombre'    => 'required|min:3|max:40',
            'apellidos' => 'required|min:3|max:50',
            'email'     => 'required|email|max:60|unique:persona,email_personal',
            'rut'       => 'required|min:9|max:10|validateRut|existeRutCliente',
            'password'  => 'required|min:5',
            'rePassword'=> 'same:password'
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.',
            'min'      => 'El campo :attribute no puede tener menos de :min carácteres.',
            'email'    => 'El campo :attribute debe ser un email válido.',
            'max'      => 'El campo :attribute no puede tener más de :min carácteres.',
            'unique'   => 'El email ingresado ya existe en la base de datos',
            'same'     => 'Contraseña y repita contraseña deben coincidir',
            'validate_rut' => 'Rut inválido',
            'existe_rut_cliente' => 'El rut ingresado no existe como cliente'
        );


        $validation = Validator::make($variable, $rules, $messages);
        // return Func::printr($validation->messages());
        if ($validation->fails())
        {
 			return Redirect::to('registro')->withErrors($validation)->withInput();
 		}

			//se ingresa nuevos datos de persona para el cliente
			$persona                 = new Persona;
			$persona->nombre         = $variable['nombre'];
			$persona->apellidos      = $variable['apellidos'];
			$persona->email_personal = $variable['email'];
			//$persona->save();
			$insertedId = $persona->id;

			//se actualiza la tabla de cliente con el password recien ingresado
			$idCliente            = registroController::getIdCliente($variable['rut']);
			$clienteU 	          = Cliente::find($idCliente);
			$clienteU->clave      = Hash::make($variable['password']);
			$clienteU->id_persona = $insertedId;
			//$clienteU->save();

			return "grabado correctamente";
<<<<<<< HEAD
=======


>>>>>>> origin/dev
	}

}