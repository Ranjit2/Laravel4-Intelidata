	<?php

/**
 * Cliente
 *
 * @property string $numero_cliente
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos2
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereNumeroCliente($value)
 */
class Cliente extends Eloquent {
	protected $table = 'cliente';
	protected $primaryKey = 'numero_cliente';

	/**
	 * [productos description]
	 * @return [type] [description]
	 */
	public function productos(){
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','id_mes', 'numero_telefonico');
	}

	/**
	 * [productos2 description]
	 * @return [type] [description]
	 */
	public function productos2(){
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','id_mes', 'numero_telefonico')->whereBetween('id_mes', array((7-6), 7))->groupBy('id_mes','numero_telefonico')->orderBy('id_mes','ASC');
	}

	/**
	 * [getChartPie description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public static function getChartPie($id, ){
		$data = array();
		foreach (Cliente::find($id)->productos2 as $value) {
			array_push($data,array(
				'producto' => $value->nombre,
				'numero'   => $value->pivot->numero_telefonico,
				'mes'      => Func::convNumberToMonth($value->pivot->id_mes),
				'monto'    => $value->pivot->monto,
				));
		}
		return $data;
	}

	/**
	 * [getChartSerial description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public static function getChartSerial($id) {
		$config = array(); $data = array(); $data2 = array(); $numbers = array(); $count = 0;
		foreach (Cliente::find($id)->productos2 as $value) {
			array_push($numbers, $value->pivot->numero_telefonico);
			if(isset($data[$value->pivot->id_mes])) {
				$data[$value->pivot->id_mes] = array_add($data[$value->pivot->id_mes], $value->pivot->numero_telefonico, $value->pivot->monto);
			} else {
				$data[$value->pivot->id_mes] = array( 'mes' => Func::convNumberToMonth($value->pivot->id_mes), $value->pivot->numero_telefonico => $value->pivot->monto, );
			}
		}
		foreach ($data as $value) { $config['data'][] = $value; }
		foreach (array_unique($numbers) as $value) {
			$config['graphs'][] = array(
				"balloonText" => "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
				"fillAlphas"  => 1,
				"labelText"   => "[[value]]",
				"lineAlpha"   => 1,
				"title"       => "Numero ". ++$count . " - " . $value,
				"type"        => "column",
				"color"       => "#000000",
				"valueField"  => $value,
				);
		}
		return $config;
	}
}