<?php
/**
 * Persona
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email_personal
 * @property string $rut
 * @property string $direccion_personal
 * @property string $direccion_work
 * @property string $telefono_fijo_personal
 * @property string $telefono_fijo_work
 * @property string $celular_personal
 * @property string $celular_work
 * @property string $email_work
 * @property string $facebook
 * @property string $twitter
 * @property string $skype
 * @method static \Illuminate\Database\Query\Builder|\Persona whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereApellidos($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereEmailPersonal($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereRut($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereDireccionPersonal($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereDireccionWork($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereTelefonoFijoPersonal($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereTelefonoFijoWork($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereCelularPersonal($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereCelularWork($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereEmailWork($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\Persona whereSkype($value)
 */
class Persona extends \Eloquent {
	protected $table      = 'persona';
	protected $primaryKey = 'id';
}