<?php

class Pregunta extends \Eloquent {
	protected $table = 'preguntas';
	protected $primaryKey = 'id';

	public function respuestas(){
			return $this->belongsToMany('Respuesta', 'pregunta_respuesta', 'id_pregunta', 'id_respuesta');
	}
}