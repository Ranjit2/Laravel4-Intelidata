<?php

/**
 * Empresa
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Categoria[] $categorias
 * @property-read \Illuminate\Database\Eloquent\Collection|\Categoria[] $categoria
 */
class Empresa extends Eloquent {
	protected $table      = 'empresa';
	protected $primaryKey = 'id';

}
