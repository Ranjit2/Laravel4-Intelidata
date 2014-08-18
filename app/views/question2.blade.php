@extends('layouts.basic')

@section('content')
{{Form::open(array('url' => 'question', 'method' => 'POST'))}}
<div class="sr-only">{{$cont = 1;}}</div>
@foreach ($preguntas as $pregunta)
<div class="row">
<div class="col-md-10 pull-right">
        <h4>{{$cont++.'.- '.$pregunta->pregunta}}</h4>
        <div class="sr-only">{{ $respuestas = Pregunta::find($pregunta->id)->respuestas()->select('respuesta')->get();}}</div>
        @foreach ($respuestas as $respuesta)
        <div class="input-group">
            <span class="input-group-addon beautiful">
                <input type="radio" name="{{$pregunta->id}}" value="{{$respuesta->id}}">
            </span>
            <label type="text" class="form-control">{{$respuesta->respuesta}}</label>
        </div>
        @endforeach
    </div>
</div>
@endforeach
<br>
<button class="btn btn-primary btn-lg pull-right" id="botonRegistrar">Modificar</button>
{{Form::close()}}
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
    /* CSS REQUIRED */
    .state-icon {
        left: -5px;
    }
    .list-group-item-primary {
        color: rgb(255, 255, 255);
        background-color: rgb(66, 139, 202);
    }

    /* DEMO ONLY - REMOVES UNWANTED MARGIN */
    .well .list-group {
        margin-bottom: 0px;
    }
</style>
@stop




