<?php

/**
 * Respuesta
 *
 * @property integer $id
 * @property string $respuesta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $delete_at
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereRespuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Respuesta whereDeleteAt($value)
 */
class Respuesta extends \Eloquent {
	protected $table = 'respuestas';
	protected $primaryKey = 'id';

    public static function correcta($id_p){
        $r = Cliente::find(Session::get('ses_user_id'))->clientePreguntas()->select('id_pregunta_respuesta')->where(DB::raw('return_pregunta(id_pregunta_respuesta)'), $id_p)->where('estado','=','A')->first()->id_pregunta_respuesta;
        return PreguntasController::devuelveRespuesta($r);
        return $r;
    }

    public static function esCorrecta($id_p, $id_r){
        $r = Cliente::find(Session::get('ses_user_id'))->clientePreguntas()->select('id_pregunta_respuesta')->where(DB::raw('return_pregunta(id_pregunta_respuesta)'), $id_p)->where('estado','=','A')->first()->id_pregunta_respuesta;
        if(PreguntasController::devuelveRespuesta($r) == $id_r){
            return true;
        }
        return false;
    }
}