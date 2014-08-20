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
        for(cant = 1; cant <= cantidadPreguntas; cant++)
        {
            if( typeof($('input[id='+cant+']:checked').val()) == 'undefined')
            {
                ok = false;
            }
        }
        if(!ok)
        {
            $('#mensaje').html('<p>Por favor responda todas las preguntas</p>');
            return false;
        }
    });
</script>
@stop

@section('content')
<fieldset>
    <legend>DATOS DE CONTACTO</legend>
    {{ Form::open(array('url' => 'question', 'method' => 'POST')); }}
    <div class="sr-only">{{$cont = 1;}}</div>
    @foreach ($preguntas as $pregunta)
    <h4 class="pregunta">{{$cont++.'.- '.$pregunta->pregunta}}</h4>
    <div class="sr-only">{{ $respuestas = Pregunta::find($pregunta->id)->respuestas()->select('respuesta')->get(); }}</div>
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
@stop