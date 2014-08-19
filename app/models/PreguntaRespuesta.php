<?php

class PreguntaRespuesta extends \Eloquent {
	protected $table = 'pregunta_respuesta';
	protected $primaryKey = 'id';

	// public static function getIdPreguntaRespuesta($idPregunta, $idRespuesta)
	// {
	// 	return PreguntaRespuesta::where('id_pregunta','=',$idPregunta)->where('id_respuesta','=',$idRespuesta)->select('id')->get();
	// }

	// public static function getPreguntaConRespuesta($id)
	// {
	// 	return PreguntaRespuesta::where('id','=',$id)->select('id_pregunta','id_respuesta')->get();
	// }

	public function clientePregunta(){
			return $this->hasMany('ClientePregunta','id_pregunta_respuesta');
	}
}