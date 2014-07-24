<?php

/**
 * Cliente
 *
 * @property string $numero_cliente
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos
 * @property-read \Illuminate\Database\Eloquent\Collection|\Mes[] $meses
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereNumeroCliente($value)
 */
class Cliente extends Eloquent {
	protected $table = 'cliente';
	protected $primaryKey = 'numero_cliente';

	public function productos(){
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','numero_telefonico', 'id_mes');
	}

	public function meses(){
		return $this->belongsToMany('Mes', 'cliente_producto', 'id_cliente', 'id_mes')->withpivot('id_mes')->groupBy('id');
	}

	public static function getChartPie($id) {
		$data = Cliente::find($id)->productos;
		$result = array();
		foreach ($data as $value) {
			$array['nombre'] = $value->nombre;
			$array['monto'] = $value->pivot->monto;
			array_push($result, $array);
		}
		return $result;
	}

	public static function getChartSerial($id) {
		// $chart = array();
		// $data = Cliente::find($id)->productos->toArray();

		// $graphs = array(
		// 	sarray(
		// 		'balloonText' => e('<b>[[title]]</b><br><span style="font-size: 4px">[[category]] => <b>[[value]]</b></span>'),
		// 		'labelText'   => '[[title]] [[value]]',
		// 		'fillAlphas'  => 0.8,
		// 		'lineAlpha'   => 0.2,
		// 		'color'       => '#000000',
		// 		'title'       => 'Europe',
		// 		'type'        => 'column',
		// 		'valueField'  => 'europe',
		// 		),
		// 	);
		// return $chart;
	}

}