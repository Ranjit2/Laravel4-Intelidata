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
		//
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

	public static function validarFormRegistro($data)
	{
		//validando
		$rules = array(
            'nombre'    => 'required|min:2|max:40',
            'apellidos' => 'required|min:5|max:50',
            'email'     => 'required|email|max:60',
            'password'  => 'required|min:8'
        );

        $validator = Validator::make($data, $rules);
        if($validator->fails())
        {
        	$mensajes = $validator->messages();
		    return Redirect::to('/registro')->withErrors($validator)->withInput();
        }
        else
        {
        	return true;
        }

    }

	public static function grabarRegistro()
	{
		$variable = Input::all();
		if(registroController::validarFormRegistro($variable))
		{
			return "correcto";
		}
		else
		{

		return "falso";
		}

		if(registroController::existeCliente($variable['rut']))//si el rut del cliente existe en la tabla cliente se guarda como persona
		{
			//se ingresa nuevos datos de persona para el cliente
			$persona                 = new Persona;
			$persona->nombre         = $variable['nombre'];
			$persona->apellidos      = $variable['apellidos'];
			$persona->email_personal = $variable['email'];
			//$persona->save();
			$insertedId = $persona->id;

			//se actualiza la tabla de cliente con el password recien ingresado
			$idCliente           = registroController::getIdCliente($variable['rut']); 
			$clienteU 	         = Cliente::find($idCliente);
			$clienteU->clave      = Hash::make($variable['password']);
			$clienteU->id_persona = $insertedId;
			//$clienteU->save();
			return "grabado correctamente";
		}
		return "El rut ingresado no existe como cliente";
	}

}