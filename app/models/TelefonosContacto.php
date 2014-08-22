<?php

/**
 * TelefonosContacto
 *
 * @property integer $id
 * @property integer $tipo
 * @property string $numero
 * @property integer $id_empresa
 * @method static \Illuminate\Database\Query\Builder|\TelefonosContacto whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\TelefonosContacto whereTipo($value) 
 * @method static \Illuminate\Database\Query\Builder|\TelefonosContacto whereNumero($value) 
 * @method static \Illuminate\Database\Query\Builder|\TelefonosContacto whereIdEmpresa($value) 
 */
class TelefonosContacto extends \Eloquent {
	protected $table      = 'telefonos_contacto';
	protected $primaryKey = 'id';
}