<?php

class Telefono extends \Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios(){
		return $this->belongsToMany('Servicio', 'telefonos_servicios', 'id_telefono', 'id_servicio')->withpivot('precio_servicio')->select('id_telefono','tipo','precio_servicio');
	}

	// public function servicios(){
	// 	return $this->belongsToMany('Servicio', 'telefonos_servicios', 'id_telefono', 'id_servicio');
	// }

	public function montos(){
		return $this->hasMany('Total', 'id_telefono')->orderBy('fecha', 'ASC')->take(13);
	}

	public function totalMesTelefono($idTelefono, $fecha)
	{
		return $this->find($id);//->productos()->where('id_mes',$mes)->get()->toArray();
	}

	public function cliente(){
		return $this->belongsTo('Cliente');
	}

}