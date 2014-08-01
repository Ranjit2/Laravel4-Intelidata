<?php

class Telefono extends \Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios(){
		return $this->belongsToMany('Servicio', 'telefonos_Servicios', 'id_servicio', 'id_telefono')->withpivot('precio_servicio')->select('id_telefono','tipo','precio_servicio');
	}

	public function montos(){
		return $this->hasMany('Total', 'id_telefono')->orderBy('fecha', 'ASC')->take(13);
	}

	public function cliente(){
		return $this->belongsTo('Cliente');
	}

}