<?php

class PreguntasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /preguntas
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /preguntas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /preguntas
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /preguntas/{id}
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
	 * GET /preguntas/{id}/edit
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
	 * PUT /preguntas/{id}
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
	 * DELETE /preguntas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function recibe()
	{
		
		// $telefonoPregunta = new telefonoPregunta;
		// $telefonoPregunta->id_telefono = $telefono;
		// $telefonoPregunta->id_pregunta_respuesta = $preguntaRespuesta;
		
		$variable = Input::all();
		$cont =0;
		foreach ($variable as $pregunta => $respuesta) {
			if($cont>0){	
			var_dump('pregunta '.$pregunta);
			var_dump('respuesta '.$respuesta);
			}
			$cont++;
		}
		die();
		// var_dump(Input::get(2));
		// var_dump(Input::get(3));
		// var_dump(Session::get('ses_user_id'));
		// die();	
	}

}