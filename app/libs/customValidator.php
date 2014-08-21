<?php

Validator::extend('validate_rut', 'CustomValidator@validate_rut');
Validator::extend('existe_rut_cliente', 'CustomValidator@existe_rut_cliente');

class CustomValidator {
    
    public function validate_rut($attribute, $value, $parameters)
    {
        $rut = Rut::format($value);
        if(Rut::validate($rut))
        	return true;
        else
        	return false;
    }

    public function existe_rut_cliente($attribute, $value, $parameters)
    {
    	if(registroController::existeCliente($value))
    		return true;
    	else
    		return false;
    }
}