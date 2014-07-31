<?php

class Telefono extends \Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios(){
		return $this->belongsToMany('Servicio', 'telefonos_Servicios', 'id_servicio', 'id_telefono');
	}

	public function montos(){
<<<<<<< HEAD
		return $this->hasMany('Total', 'id_telefono')->orderBy('fecha', 'asc');
=======
		return $this->hasMany('Total', 'id_telefono')->orderBy('fecha', 'desc')->take(13);
>>>>>>> origin/dev
	}

}