<?php

/**
 * ClientePregunta
 *
 * @property integer $id
 * @property integer $id_cliente
 * @property integer $id_pregunta_respuesta
 * @property string $estado
 * @property string $fecha_ingreso
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \PreguntaRespuesta $preguntaRespuesta
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereIdPreguntaRespuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereFechaIngreso($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ClientePregunta whereDeletedAt($value)
 */
class ClientePregunta extends \Eloquent {
	protected $table = 'cliente_preguntas';
	protected $primaryKey = 'id';

	/**
	 * [preguntaRespuesta description]
	 * @return [type] [description]
	 */
	public function preguntaRespuesta() {
		return $this->belongsTo('PreguntaRespuesta','id');
	}

	/**
	 * [getPreguntaRespondida description]
	 * @param  [type] $idCliente  [description]
	 * @param  [type] $idPregunta [description]
	 * @return [type]             [description]
	 */
	public static function getPreguntaRespondida($idCliente, $idPregunta) {
		return ClientePregunta::where('id_cliente','=',$idCliente)->get();
	}



}

