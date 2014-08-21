<?php

/**
 * Respuesta
 *
 * @property integer $id
 * @property string $respuesta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $delete_at
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereRespuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereDeleteAt($value)
 */
class Respuesta extends \Eloquent {
	protected $table = 'respuestas';
	protected $primaryKey = 'id';
}