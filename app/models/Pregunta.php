<?php

/**
 * Pregunta
 *
 * @property integer $id
 * @property string $pregunta
 * @property string $estado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Respuesta[] $respuestas
 * @method static \Illuminate\Database\Query\Builder|\Pregunta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Pregunta wherePregunta($value)
 * @method static \Illuminate\Database\Query\Builder|\Pregunta whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Pregunta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Pregunta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Pregunta whereDeletedAt($value)
 * @method static \Pregunta whereNot()
 */
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