<?php

/**
* Producto
*
* @property integer $id
* @property string $nombre
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property string $deleted_at
* @property-read \Illuminate\Database\Eloquent\Collection|\Mes[] $meses
* @property-read \Illuminate\Database\Eloquent\Collection|\Cliente[] $clientes
* @method static \Illuminate\Database\Query\Builder|\Producto whereId($value)
* @method static \Illuminate\Database\Query\Builder|\Producto whereNombre($value)
* @method static \Illuminate\Database\Query\Builder|\Producto whereCreatedAt($value)
* @method static \Illuminate\Database\Query\Builder|\Producto whereUpdatedAt($value)
* @method static \Illuminate\Database\Query\Builder|\Producto whereDeletedAt($value)
*/
class Producto extends Eloquent {
	protected $table = 'producto';
	protected $primaryKey = 'id';

	/**
	* [meses description]
	* @return [type] [description]
	*/
	public function meses(){
		return $this->belongsToMany('Mes', 'cliente_producto', 'id_producto', 'id_mes')->withpivot('id');
	}

	/**
	* [clientes description]
	* @return [type] [description]
	*/
	public function clientes(){
		return $this->belongsToMany('Cliente', 'cliente_producto', 'id_producto', 'id_cliente')->withpivot('id');
	}

	public static function postTelefonosPorProducto ($id, $id_producto, $date) {
		// $hasta = Carbon::now()->format('Y-m-d');
		// $desde = Carbon::now()->subMonths(13)->format('Y-m-d');

		$a = DB::table('telefono')
		->select('total.fecha', 'telefono.id_producto', 'producto.nombre', 'telefono.numero', 'total.monto_total')
		->join('producto', 'telefono.id_producto', '=', 'producto.id')
		->join('total', 'telefono.id', '=', 'total.id_telefono')
		->where('telefono.id_cliente', $id)
		->where('telefono.id_producto', $id_producto)
		->whereRaw('MONTH(total.fecha) = ' . 9  . ' AND YEAR(total.fecha) = ' . 2014)
		->orderBy('producto.nombre')
		->get();

		$array = array();
		foreach ($a as $key => $value) {
			$array[] = array(
				'fecha' => $value->fecha,
				'numero' => $value->numero,
				'monto' => $value->monto_total,
				);
		}
		Func::printr($array);

	}
}