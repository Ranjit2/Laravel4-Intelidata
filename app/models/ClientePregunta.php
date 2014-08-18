<?php

class ClientePregunta extends \Eloquent {
	protected $table = 'cliente_preguntas';
	protected $primaryKey = 'id';

	
	public function preguntaRespuesta()
	{
		return $this->belongsTo('PreguntaRespuesta','id');
	}

	



	// public static function getPreguntaRespondida($idCliente, $idPregunta)
	// {
	// 	return ClientePregunta::where('id_cliente','=',$idCliente)->get();
		
		
	// }



}

