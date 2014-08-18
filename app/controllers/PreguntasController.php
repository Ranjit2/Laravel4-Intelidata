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

	public function devuelvePregunta($idPreguntaRespuesta)
	{
		return preguntaRespuesta::find($idPreguntaRespuesta)->id_pregunta;	
	}

	public function devuelvePreguntaRespuesta($idPregunta, $idRespuesta)
	{
		return preguntaRespuesta::where('id_pregunta','=',$idPregunta)->where('id_respuesta','=',$idRespuesta)->select('id')->get()[0]['id'];
	}


	public function preguntaRespondida($idPregunta)
	{
		//Session::get('ses_user_id')
		$valores = Cliente::find(Session::get('ses_user_id'))->clientePreguntas()->where(DB::raw('return_pregunta(id_pregunta_respuesta)'),'=',$idPregunta)->get();
		foreach ($valores as $value) 
		{
			return true;	
		}
		return false;
	}

	public function devuelveIdClientePreguntaRespuesta($idCliente, $idPregunta)
	{
		return ClientePregunta::where(DB::raw('return_pregunta(id_pregunta_respuesta)'),'=',$idPregunta)->where('id_cliente','=',$idCliente)->select('id')->get()[0]['id'];
	}


	public function recibe()
	{
		$variable = Input::except('_token');
		$idCliente = Session::get('ses_user_id');
		foreach ($variable as $pregunta => $respuesta)
		{
			if($this->preguntaRespondida($pregunta))
			{
				$idPreguntaRespuesta = $this->devuelvePreguntaRespuesta($pregunta, $respuesta);
				$idClientePregunta   = $this->devuelveIdClientePreguntaRespuesta($idCliente, $pregunta);
				//$clientePreguntaU 	 = new ClientePregunta;
				// var_dump("pregunta ".$pregunta);
				// var_dump("Respuesta ".$respuesta);
				// var_dump("id pregunta respuesta ".$idPreguntaRespuesta);
				// var_dump("id cliente pregunta repetida ".$idClientePregunta);
				//var_dump("cliente pregunta repetida ".ClientePregunta::find($idClientePregunta));
				
				//var_dump(ClientePregunta::find($idPreguntaRespuesta));
				$clientePreguntaU 	 = ClientePregunta::find($idClientePregunta);
				$clientePreguntaU->estado = 'B';
			 	//$clientePreguntaU->save();
			}
			$clientePregunta = new ClientePregunta;	
			$clientePregunta->id_cliente = $idCliente;
			$clientePregunta->id_pregunta_respuesta = $this->devuelvePreguntaRespuesta($pregunta, $respuesta);
			//$clientePregunta->save();
		}
		return Redirect::to('/question');	
	}
}