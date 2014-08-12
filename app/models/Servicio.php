<?php

/**
 * Servicio
 *
 * @property integer $id
 * @property string $tipo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Telefono[] $telefonos
 * @method static \Illuminate\Database\Query\Builder|\Servicio whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Servicio whereTipo($value) 
 * @method static \Illuminate\Database\Query\Builder|\Servicio whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Servicio whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Servicio whereDeletedAt($value) 
 */
class Servicio extends \Eloquent {

	protected $table = 'servicio';
	protected $primaryKey = 'id';

	public function telefonos(){
		return $this->belongsToMany('Telefono', 'telefonos_Servicios', 'id_telefono', 'id_servicio')->withpivot('id');
	}
}