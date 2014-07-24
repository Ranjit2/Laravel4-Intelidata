@extends('layouts.basic')
@section('login')
{{ Form::open(array('url' => 'envioForm','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name','Username: ')}}
    {{Form::text('username',Input::old('username'),array('class' => 'form-control'))}}
    {{$errors->first('username');}}
</div>
<div class="form-group">
    {{Form::label('password','Password: ')}}
    {{Form::password('password',array('class' => 'form-control'))}}
    {{$errors->first('password');}}
</div>
<div class="form-group">
	{{Form::label('email','Email: ')}}
    {{Form::email('email','',array('class' => 'form-control'))}}
    {{$errors->first('email');}}
</div>
<div class="form-group">
    {{Form::label('activo','Activo: ')}}
    {{Form::checkbox('activo', 'value', true)}}
</div>
{{Form::submit('Click Me!',array('class'=>'btn btn-default'))}}
{{ Form::close() }}
@stop

@section('content')
{{ $var or 'HOLA' }}
<!-- <div id="chartdiv2" style="width: 100%; height: 400px;"></div> -->
 <div id="chartdiv" style="width: 100%; height: 300px;"></div>


    {{Form::label('name','Username: ')}}
    {{Form::text('empresa','',array('id' =>'txtEmpresa', 'class' => 'form-control'))}}
    {{Form::button('Click Me!',array('id'=>'btnEnviar', 'class'=>'btn btn-default'))}}
@stop


@section('script')
    $("#btnEnviar").on('click', function (e) {
        e.preventDefault();

        
        mostrarGrafico();
        


    });






@stop






