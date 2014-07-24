<?php

class Mes extends Eloquent {
	protected $table = 'mes';
	protected $primaryKey = 'id';

	public function productos(){
        return $this->belongsToMany('Producto', 'cliente_producto', 'id_mes', 'id_producto')->withPivot('id');
    }

    public function clientes(){
        return $this->belongsToMany('Cliente', 'cliente_producto', 'id_mes', 'id_cliente')->withPivot('id');
    }
}
