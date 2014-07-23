<?php

class Categoria extends Eloquent {
	protected $table = 'categoria';
	protected $primaryKey = 'id';

	public function empresas(){
        return $this->belongsToMany('Empresa', 'empresa_categoria', 'id_categoria', 'id_empresa')->withPivot('id');
    }

}
