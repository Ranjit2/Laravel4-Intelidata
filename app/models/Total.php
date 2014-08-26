<?php

/**
 * Total
 *
 * @property integer $id
 * @property integer $id_telefono
 * @property string $fecha
 * @property integer $monto_total
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\Total whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereIdTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereMontoTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Total whereDeletedAt($value)
 */
class Total extends Eloquent {
	protected $table = 'total';
	protected $primaryKey = 'id';

	public function telefono(){
		return $this->belongsTo('Telefono','id_telefono');
	}
}