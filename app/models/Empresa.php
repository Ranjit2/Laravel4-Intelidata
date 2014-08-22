<?php

/**
 * Empresa
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Categoria[] $categorias
 * @property-read \Illuminate\Database\Eloquent\Collection|\Categoria[] $categoria
 * @property integer $id
 * @property string $rut
 * @property string $nombre
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereRut($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereNombre($value)
 */
class Empresa extends Eloquent {
	protected $table      = 'empresa';
	protected $primaryKey = 'id';
}
