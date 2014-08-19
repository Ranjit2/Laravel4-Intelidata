<?php

class Pregunta extends Eloquent {
	protected $table = 'preguntas';
	protected $primaryKey = 'id';

	public function respuestas() {
		return $this->belongsToMany('Respuesta', 'pregunta_respuesta', 'id_pregunta', 'id_respuesta');
	}

	public static function scopeWhereNot($user_id) {
		return Pregunta::whereNotIn('id', function($query) use ($user_id) {
			$query->select('pregunta_respuesta.id_pregunta')
			->from('pregunta_respuesta')
			->join('cliente_preguntas', 'pregunta_respuesta.id', '=', 'cliente_preguntas.id_pregunta_respuesta')
			->whereRaw('cliente_preguntas.id_cliente = '.$user_id);
		})->where('estado','A')->groupBy('id')->get();
	}

}