<?php

class PreguntasController extends BaseController {

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		$preguntas = Pregunta::scopeWhereNot(Session::get('ses_user_id'));
		return View::make('perfil')->with('preguntas', $preguntas);
	}

	/**
	 * [index2 description]
	 * @return [type] [description]
	 */
	public function index2 () {
		return View::make('question2')->with('preguntas', Pregunta::where('estado', 'A')->get());
	}

	/**
	* [devuelvePregunta description]
	* @param  [type] $idPreguntaRespuesta
	* @return [type]
	*/
	public function devuelvePregunta($idPreguntaRespuesta)
	{
		return PreguntaRespuesta::find($idPreguntaRespuesta)->id_pregunta;
	}

	/**
	* [devuelveRespuesta description]
	* @param  [type] $idPreguntaRespuesta
	* @return [type]
	*/
	public static function devuelveRespuesta($idPreguntaRespuesta) {
		return PreguntaRespuesta::find($idPreguntaRespuesta)->id_respuesta;
	}

	/**
	* [devuelvePreguntaRespuesta description]
	* @param  [type] $idPregunta
	* @param  [type] $idRespuesta
	* @return [type]
	*/
	public function devuelvePreguntaRespuesta($idPregunta, $idRespuesta) {
		return PreguntaRespuesta::select('id')->where('id_pregunta','=',$idPregunta)->where('id_respuesta','=',$idRespuesta)->first()->id;
	}

	/**
	* [preguntaRespondida description]
	* @param  [type] $idPregunta
	* @return [type]
	*/
	public function preguntaRespondida($idPregunta) {
		return Cliente::find(Session::get('ses_user_id'))->clientePreguntas()->where(DB::raw('return_pregunta(id_pregunta_respuesta)'), $idPregunta)->where('estado','A')->first();
	}

	/**
	* [devuelveIdClientePreguntaRespuesta description]
	* @param  [type] $idCliente
	* @param  [type] $idPregunta
	* @return [type]
	*/
	public function devuelveIdClientePreguntaRespuesta($idCliente, $idPregunta) {
		return ClientePregunta::where(DB::raw('return_pregunta(id_pregunta_respuesta)'),'=',$idPregunta)->where('id_cliente','=',$idCliente)->select('id')->where('estado', 'A')->first()->id;
	}

	/**
	* [recibe description]
	* @return [type]
	*/
	public function recibe() {
		foreach (Input::except('_token') as $p => $r) {
			if($a = $this->preguntaRespondida((int) $p)) {
				$a->estado = 'B';
				$a->save();
			}
			$clientePregunta                        = new ClientePregunta;
			$clientePregunta->id_cliente            = Session::get('ses_user_id');
			$clientePregunta->id_pregunta_respuesta = $this->devuelvePreguntaRespuesta((int) $p, (int) $r);
			$clientePregunta->save();
		}
		return Redirect::to('/home');
	}

}