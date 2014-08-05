<?php

class Telefono extends \Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios(){
<<<<<<< HEAD
		return $this->belongsToMany('Servicio', 'telefonos_Servicios', 'id_telefono', 'id_servicio')->withpivot('precio_servicio')->select('id_telefono','tipo','precio_servicio');
=======
		return $this->belongsToMany('Servicio', 'telefonos_servicios', 'id_telefono', 'id_servicio')->withpivot('precio_servicio')->select('id_telefono','tipo','precio_servicio');
>>>>>>> origin/dev
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

	public static function telefonosConServicios($nroCliente, $fecha)
	{
		$telefonos = Cliente::find($nroCliente)->numeros; //devuelve id y numeros del telefono del cliente a buscar
		$date      = new Carbon($fecha);
		$month     = $date->month;
		$year      = $date->year;
		$arregloTelefonos = array();
		$arregloTelefonos = array();
		foreach ($telefonos as $value)
		{
			$telefono = new stdClass();
			$arregloServicios = array();
			$arregloSer = array();
			$arrayAux = array();
			$idTelefono = $value['id'];
			$numero     = $value['numero'];
			$totalTelefono = Telefono::find($idTelefono)->montos()->where(DB::raw('MONTH(fecha)'),'=',$month)->where(DB::raw('YEAR(fecha)'),'=',$year)->where(DB::raw('YEAR(fecha)'),'=',$year)->select('monto_total')->get()[0]['monto_total'];
			$telefono->type    = $numero;
			$telefono->percent = $totalTelefono;
			foreach (Telefono::find($idTelefono)->servicios as $value2)//devuelve id telefono, servicio y monto serv
			{
				$subs         = new stdClass();
				$subs->type   = $value2['tipo'];
				$subs->percent = $value2['precio_servicio'];
				$arrayAux[] = $subs;
			}
			$telefono->subs = $arrayAux;
			$arregloTelefonos[] = $telefono;
		}
		return Response::json($arregloTelefonos);
	}

}