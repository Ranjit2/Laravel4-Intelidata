<?php

class PreguntasController extends \BaseController {

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
			 	$clientePreguntaU->save();
			}
			$clientePregunta = new ClientePregunta;
			$clientePregunta->id_cliente = $idCliente;
			$clientePregunta->id_pregunta_respuesta = $this->devuelvePreguntaRespuesta($pregunta, $respuesta);
			$clientePregunta->save();
		}
		return Redirect::to('/home');
	}
}