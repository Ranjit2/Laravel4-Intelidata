@extends('layouts.two_column')

@section('style')
<style type="text/css">
</style>
@stop

@section('script')
<script>
$("#botonRegistrar").click(function(){

    var cantidadPreguntas = $(".pregunta").length;

    var ok = true;
    var arregloRespuestas = [];
    var contador = 0;
    for(cant = 1; cant <= cantidadPreguntas; cant++)
    {
        arregloRespuestas[contador] = $('input[id='+cant+']:checked');
        if( typeof($('input[id='+cant+']:checked').val()) == 'undefined')
        {
            ok = false;
        }
        contador++;
    }


    //recorremos las respuestas para ver que tipo de medio de comunicacion eligio
    for(var arr in arregloRespuestas)
    {
        var dato = arregloRespuestas[arr][0].defaultValue;
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
    //valida si le falto contestar alguna pregunta
    if(!ok)
    {
        $('#mensaje').html('<p>Por favor responda todas las preguntas</p>');
        return false;
    }
});
</script>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <fieldset>
                    <legend>DATOS DE CONTACTO</legend>
                    {{ Form::open(array('url' => 'question', 'method' => 'POST')); }}
                    <div class="sr-only">{{$cont = 1;}}</div>
                    @foreach ($preguntas as $pregunta)
                    <h4 class="pregunta">{{$cont++.'.- '.$pregunta->pregunta}}</h4>
                    <div class="sr-only">{{ $respuestas = Pregunta::find($pregunta->id)->respuestas()->select('respuestas.id','respuesta')->get(); }}</div>
                    <div class="form-group">
                        @foreach ($respuestas as $respuesta)
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" id ="{{$cont-1}}" name="{{$pregunta->id}}" value="{{$respuesta->id}}">
                            </span>
                            <label type="text" class="form-control">{{$respuesta->respuesta}}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    <div style="color:red; font-weight: bold;" id="mensaje"></div>
                    <p class="pull-right">
                        {{ HTML::link('/logout', 'VOLVER', array('class' => 'btn btn-default btn-lg')); }}
                        {{ Form::submit('REGÍSTRATE', array('id' => 'botonRegistrar' , 'class' => 'btn btn-primary btn-lg')); }}
                    </p>
                    {{ Form::close(); }}
                </fieldset>
            </div>
        </div>
    </div>
</div>
@stop