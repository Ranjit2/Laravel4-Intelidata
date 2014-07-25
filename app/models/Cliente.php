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
		Debugbar::info($data);
		foreach ($data as $value) {
			array_push($result,array(
				'producto' => $value->nombre,
				'numero'   => $value->pivot->numero_telefonico,
				'mes'      => Func::convNumberToMonth($value->pivot->id_mes),
				'monto'    => $value->pivot->monto,
				));
		}
		return $result;
	}

	public static function getChartSerial($id) {
		$d = Cliente::find($id)->productos;
		$data = array();
		$numeros = array();
		$count = 0;

		foreach ($d as $value) {
			array_push($numeros, $value->pivot->numero_telefonico);

			while () {
			}
		}

		Func::printr(array_unique($numeros));
	}
}