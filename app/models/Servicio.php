<?php

class Servicio extends \Eloquent {

	protected $table = 'servicio';
	protected $primaryKey = 'id';

	public function telefonos(){
		return $this->belongsToMany('Telefono', 'telefonos_Servicios', 'id_telefono', 'id_servicio')->withpivot('id');
	}
}