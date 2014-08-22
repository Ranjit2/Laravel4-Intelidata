<?php

/**
 * CentroDeAyuda
 *
 * @property integer $id
 * @property string $producto
 * @property integer $id_empresa
 * @method static \Illuminate\Database\Query\Builder|\CentroDeAyuda whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\CentroDeAyuda whereProducto($value) 
 * @method static \Illuminate\Database\Query\Builder|\CentroDeAyuda whereIdEmpresa($value) 
 */
class CentroDeAyuda extends \Eloquent {
	protected $table      = 'centro_de_ayuda';
	protected $primaryKey = 'id';
}