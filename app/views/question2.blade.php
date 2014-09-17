@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ HTML::genera_contacto($preguntas) }}
            </div>
        </div>
    </div>
</div>
@stop

@section('aside')
@parent
@stop

@section('script')
<script>
$("#botonRegistrar").click(function(){
    //console.log($('input:radio[name=4]:checked').val());
    

    var radioButtonSelected = ($('input:radio:checked')); //0 al 3 trae las 4 preguntas
    var cantidadPreguntas = {{count($preguntas)}};


    //recorremos las respuestas para ver que tipo de medio de comunicacion eligio
    for(var cont = 0; cont < cantidadPreguntas; cont++)
    {
        
    	//filter_var(ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'twitter'), FILTER_VALIDATE_BOOLEAN);

        var dato = radioButtonSelected[cont].defaultValue;
        var tieneTelefono   = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'telefono')}};
        var tieneCelular    = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'celular')}};
        var tieneEmail      = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'email')}};
        var tieneDireccion  = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'direccion')}};
		var tieneFacebook   = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'facebook')}};       
		var tieneTwitter    = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'twitter')}};       
		var tieneSkype      = {{ClienteController::existeDatoCliente(Session::get('ses_user_id'), 'skype')}};       

        if(dato == 1)//telefono y celular
        {
            if(!tieneTelefono && !tieneCelular)
            {
                $('#mensaje').html('<p>Aun no ha ingresado el telefono o el celular en perfil</p>');
                return false;
            }
        }

        if(dato == 2)//email
        {
            if(!tieneEmail) 
            	
            {
                $('#mensaje').html('<p>Aun no ha ingresado el email</p>');
                return false;
            }
        }

        if(dato == 3)//correo postal valida direccion
        {
            if(!tieneDireccion) 
            {
                $('#mensaje').html('<p>Aun no ha ingresado la direccion para el correo postal en perfil</p>');
                return false;
            }
        }

        if(dato == 4)//redes sociales FB, skype, twitter
        {
            if(!tieneFacebook && !tieneSkype && !tieneTwitter) 
            {
                $('#mensaje').html('<p>Aun no ha ingresado las redes sociales en perfil</p>');
                return false;
            }
        }
    }

});
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop




