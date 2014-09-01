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

}