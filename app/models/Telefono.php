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
class Telefono extends Eloquent {
	protected $table = 'telefono';
	protected $primaryKey = 'id';

	public function servicios() {
		return $this->belongsToMany('Servicio', 'telefonos_servicios', 'id_telefono', 'id_servicio')->withpivot('precio_servicio','fecha')->select('id_telefono','tipo','precio_servicio');
	}

	public function montos() {
		return $this->hasMany('Total', 'id_telefono')->orderBy('fecha', 'ASC');
	}

	public static function getNumero($idTelefono) {
		return Telefono::find($idTelefono)->numero;
	}

	public function cliente() {
		return $this->belongsTo('Cliente');
	}

	public function totales(){
		return $this->hasMany('total', 'id_telefono');
	}

	public static function postTelefonosConServicios($nroCliente, $fecha) {
		$date = new Carbon($fecha);
		$b = array(); $c = array();
		foreach ($telefonos = Cliente::find(Session::get('ses_user_id'))->numeros as $k => $value) {
			$id     = $value->id;
			$mt = Telefono::find($id)->montos()->select('monto_total')->where(DB::raw('MONTH(fecha)'),  $date->month)->where(DB::raw('YEAR(fecha)'), $date->year)->get()->toArray();
			$percent = array_get($mt, '0.monto_total');
			array_push($b, array(
				'type' => $value->numero,
				'percent' => Telefono::find($value->id)->montos()->where(DB::raw('MONTH(fecha)'),  $date->month)->where(DB::raw('YEAR(fecha)'), $date->year)->first()->monto_total,
				'subs' => array(),
				));
			foreach (Telefono::find($id)->servicios()->select('tipo', 'precio_servicio')->where(DB::raw('MONTH(fecha)'), $date->month)->where(DB::raw('YEAR(fecha)'), $date->year)->get() as $value) {
				$c = array('type' => $value->tipo, 'percent' => $value->precio_servicio, );
				array_push($b[$k]['subs'], $c);
			}
		}
		$a['data'] = $b;
		// Func::printr($a);
		// die();
		return Response::json($a);
	}

	public static function categoriasConServicios($nroCliente, $fecha) {
		$date = new Carbon($fecha);
		foreach ($telefonos = Cliente::find(Session::get('ses_user_id'))->categorias as $value)
		{
			$categorias = new stdClass;
			$categorias->nombre = Producto::find($value->id_producto)->nombre;


			// $id     = $value->id;
			// array_push($b, array(
			// 	'type' => $value->id_producto,
			// 	'percent' => Telefono::find($value->id)->montos()->where(DB::raw('MONTH(fecha)'),  $date->month)->where(DB::raw('YEAR(fecha)'), $date->year)->first()->monto_total,
			// 	'subs' => array(),
			// 	));
		}
		$b['data'] = $b;
		return Response::json($b);
	}

	public static function tl_total() {
		$items_per_group = (int) 1;
		$data = DB::select('SELECT f.id, c.numero_cliente, f.numero, f.informacion_al , f.inicio_fac, f.fin_fac
			FROM cliente c
			INNER JOIN telefono f ON c.id = f.id_cliente
			INNER JOIN total t ON f.id = t.id_telefono
			WHERE c.id = ?
			ORDER BY t.fecha DESC;', array(Session::get('ses_user_id')));
		$total_records = count($data);
		$total_records = ceil($total_records/$items_per_group);
		return $total_records;
	}

	public static function tl_paginate($gn = 0){
		$items_per_group = (int) 1;
		$position = ($gn * $items_per_group);
		$data = DB::select('SELECT c.numero_cliente, f.numero, f.informacion_al , f.inicio_fac, f.fin_fac
			FROM cliente c
			INNER JOIN telefono f ON c.id = f.id_cliente
			INNER JOIN total t ON f.id = t.id_telefono
			WHERE c.id = ?
			ORDER BY t.fecha DESC
			LIMIT ?, ?;', array(Session::get('ses_user_id'), (int) $position, (int) $items_per_group));
		if ($data) {
			return $data;
		} else {
			return "Ha ocurrido un error";
		}
	}
}