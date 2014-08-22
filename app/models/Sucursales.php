<?php

/**
 * Sucursales
 *
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property string $horario atencion
 * @property integer $id_empresa
 * @method static \Illuminate\Database\Query\Builder|\Sucursales whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Sucursales whereNombre($value) 
 * @method static \Illuminate\Database\Query\Builder|\Sucursales whereDireccion($value) 
 * @method static \Illuminate\Database\Query\Builder|\Sucursales whereHorarioAtencion($value) 
 * @method static \Illuminate\Database\Query\Builder|\Sucursales whereIdEmpresa($value) 
 */
class Sucursales extends \Eloquent {
	protected $table      = 'sucursales';
	protected $primaryKey = 'id';
}