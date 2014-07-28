<?php

/**
 * Categoria
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Empresas[] $empresas
 */
class Categoria extends Eloquent {

	protected $table      = 'categoria';
	protected $primaryKey = 'id';

	public function empresas(){
        return $this->belongsToMany('Empresas', 'empresa_categoria', 'id_categoria', 'id_empresa')->withPivot('id');
    }
}
