<?php

class PreguntasController extends \BaseController {

	public function devuelvePregunta($idPreguntaRespuesta)
	{
		return preguntaRespuesta::find($idPreguntaRespuesta)->id_pregunta;
	}

	public static function devuelveRespuesta($idPreguntaRespuesta)
	{
		return preguntaRespuesta::find($idPreguntaRespuesta)->id_respuesta;
	}

	public function devuelvePreguntaRespuesta($idPregunta, $idRespuesta)
	{
		return preguntaRespuesta::select('id')->where('id_pregunta','=',$idPregunta)->where('id_respuesta','=',$idRespuesta)->get()[0]['id'];
	}

	public function preguntaRespondida($idPregunta)
	{
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
		foreach ($variable as $pregunta => $respuesta) {
			if($this->preguntaRespondida((int) $pregunta)) {
				$idPreguntaRespuesta      = $this->devuelvePreguntaRespuesta((int) $pregunta, (int) $respuesta);
				$idClientePregunta        = $this->devuelveIdClientePreguntaRespuesta($idCliente, (int) $pregunta);
				$clientePreguntaU         = ClientePregunta::find($idClientePregunta);
				$clientePreguntaU->estado = 'B';
				$clientePreguntaU->save();
			}

			$clientePregunta = new ClientePregunta;
			$clientePregunta->id_cliente = $idCliente;
			$clientePregunta->id_pregunta_respuesta = $this->devuelvePreguntaRespuesta((int) $pregunta, (int) $respuesta);
			$clientePregunta->save();
		}
		return Redirect::to('/home');
	}


}