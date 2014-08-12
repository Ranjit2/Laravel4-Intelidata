<?php

/**
 * Telefono
 *
 * @property integer $id
 * @property integer $id_cliente
 * @property integer $id_titular_adicional
 * @property integer $id_producto
 * @property string $numero
 * @property string $informacion_al
 * @property string $inicio_fac
 * @property string $fin_fac
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Servicio[] $servicios
 * @property-read \Illuminate\Database\Eloquent\Collection|\Total[] $montos
 * @property-read \Cliente $cliente
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereIdTitularAdicional($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereIdProducto($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereInformacionAl($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereInicioFac($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereFinFac($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Telefono whereDeletedAt($value)
 */
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

	public static function totales(){
		return DB::select('SELECT c.numero_cliente, f.numero, t.fecha, FORMAT(t.monto_total,0) AS monto_total
					FROM cliente c
					INNER JOIN telefono f ON c.id = f.id_cliente
					INNER JOIN total t ON f.id = t.id_telefono
					WHERE c.id = ?
					ORDER BY t.fecha DESC;', array(Session::get('ses_user_id')));
	}

}