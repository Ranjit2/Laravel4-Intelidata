<?php

class Cliente extends Eloquent {
	protected $table = 'cliente';
	protected $primaryKey = 'numero_cliente';

	public function productos(){
        return $this->belongsToMany('Producto', 'cliente_producto', 'id_cliente', 'id_producto')->withpivot('monto','numero_telefonico', 'id_mes');
    }

    public function meses(){
        return $this->belongsToMany('Mes', 'cliente_producto', 'id_cliente', 'id_mes')->withpivot('id_mes')->groupBy('id');
    }


}
