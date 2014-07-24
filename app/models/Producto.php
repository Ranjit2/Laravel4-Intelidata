<?php

class Producto extends Eloquent {
	protected $table = 'producto';
	protected $primaryKey = 'id';

	public function meses(){
        return $this->belongsToMany('Mes', 'cliente_producto', 'id_producto', 'id_mes')->withpivot('id');
    }

    public function clientes(){
        return $this->belongsToMany('Cliente', 'cliente_producto', 'id_producto', 'id_cliente')->withpivot('id');
    }
}
