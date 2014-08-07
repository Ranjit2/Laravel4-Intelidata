<?php

class Telefono extends \Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios(){
		return $this->belongsToMany('Servicio', 'telefonos_servicios', 'id_telefono', 'id_servicio')->withpivot('precio_servicio','fecha')->select('id_telefono','tipo','precio_servicio');
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
		$telefonos        = Cliente::find($nroCliente)->numeros;
		$date             = new Carbon($fecha);
		$month            = $date->month;
		$year             = $date->year;
		$arregloTelefonos = array();
		$arregloTelefonos = array();
		foreach ($telefonos as $value)
		{
			$telefono          = new stdClass();
			$arregloServicios  = array();
			$arregloSer        = array();
			$arrayAux          = array();
			$idTelefono        = $value['id'];
			$numero            = $value['numero'];
			$totalTelefono     = Telefono::find($idTelefono)->montos()->where(DB::raw('MONTH(fecha)'),'=',$month)->where(DB::raw('YEAR(fecha)'),'=',$year)->select('monto_total')->get()[0]['monto_total'];
			$telefono->type    = $numero;
			$telefono->percent = $totalTelefono;
			foreach (Telefono::find($idTelefono)->servicios()->where(DB::raw('MONTH(fecha)'),'=',$month)->where(DB::raw('YEAR(fecha)'),'=',$year)->get() as $value2)
			{
				$subs          = new stdClass();
				$subs->type    = $value2['tipo'];
				$subs->percent = $value2['precio_servicio'];
				$arrayAux[]    = $subs;
			}
			$telefono->subs     = $arrayAux;
			$arregloTelefonos[] = $telefono;
		}
		return Response::json($arregloTelefonos);
	}

	// public static function datosFactura () {
	// 	Telefono::
	// 	return ;
	// }

}