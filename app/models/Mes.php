<?php

class Mes extends Eloquent {
	protected $table = 'mes';
	protected $primaryKey = 'id';

	public function empresasCategorias(){
        return $this->belongsToMany('EmpresaCategorias', 'emp_categ_mes', 'id_empresa_categoria', 'id_mes');
    }
}
