<?php

class Empresa extends Eloquent {

	protected $table = 'empresa';
	protected $primaryKey = 'id';

	public function categorias(){
        return $this->belongsToMany('Categoria', 'empresa_categoria', 'id_empresa', 'id_categoria')->withPivot('id');
    }

    
}
