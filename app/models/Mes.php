<?php

/**
 * Mes
 *
 * @property integer $id
 * @property string $mes
 * @property integer $year
 * @property-read \Illuminate\Database\Eloquent\Collection|\Producto[] $productos
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cliente[] $clientes
 * @method static \Illuminate\Database\Query\Builder|\Mes whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Mes whereMes($value)
 * @method static \Illuminate\Database\Query\Builder|\Mes whereYear($value)
 */
class Mes extends Eloquent {
	protected $table = 'mes';
	protected $primaryKey = 'id';

	public function productos(){
		return $this->belongsToMany('Producto', 'cliente_producto', 'id_mes', 'id_producto')->withPivot('id');
	}

	public function clientes(){
		return $this->belongsToMany('Cliente', 'cliente_producto', 'id_mes', 'id_cliente')->withPivot('id');
	}
}