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

    /**
     * [categorias description]
     * @return [type] [description]
     */
    public function categorias(){
        return $this->belongsToMany('Categoria', 'empresa_categoria', 'id_empresa', 'id_categoria')->withPivot('id');
    }

    /**
     * [categoria description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function categoria($id = NULL){
		$categoria = $this->belongsToMany('Categoria', 'empresa_categoria', 'id_empresa', 'id_categoria')->withPivot('id')->where('id_categoria', $id)->firstOrFail();
		return $categoria;
	}

    /**
     * [idPivot description]
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public static function idPivot($id = 1){
		$qry = Empresa::find($id)->categorias;
		foreach ($qry as $value) {
			$id_pivot[] = $value->pivot->id;
		}
		return $id_pivot;
    }
}
