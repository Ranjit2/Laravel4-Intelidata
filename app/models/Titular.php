<?php

/**
 * Titular
 *
 * @property integer $id
 * @property string $tipo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\Titular whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Titular whereTipo($value) 
 * @method static \Illuminate\Database\Query\Builder|\Titular whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Titular whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Titular whereDeletedAt($value) 
 */
class Titular extends Eloquent {
	protected $fillable = [];
	protected $table      = 'titular_adicional';
	protected $primaryKey = 'id';

}