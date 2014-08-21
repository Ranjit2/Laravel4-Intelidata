@extends('layouts.dashboard')

@section('content')
<div class="sr-only">{{$cont = 1;}}</div>
<fieldset class="col-md-offset-1">
    <legend>Contacto</legend>
    {{Form::open()}}
    @foreach ($preguntas as $pregunta)
    <h4>{{$cont++.'.- '.$pregunta->pregunta}}</h4>
    <div class="sr-only">{{ $respuestas = Pregunta::find($pregunta->id)->respuestas()->select('respuesta')->get();
     }}</div>
    @foreach ($respuestas as $respuesta)
    <div class="input-group col-md-7">
        <span class="input-group-addon beautiful">
            <input type="radio" name="{{$pregunta->id}}" value="{{$respuesta->id}}"
            {{ HTML::respondida($pregunta->id, $respuesta->id) }}>
        </span>
        <label type="text" class="form-control">{{$respuesta->respuesta}}</label>
    </div>
    @endforeach
    @endforeach
    <br>
    <button class="btn btn-primary btn-lg pull-right" id="botonRegistrar">Modificar</button>
    {{Form::close()}}
</fieldset>
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop




