@extends('layouts.two_column')

@section('content')
<h3 class="text-left">HOY COMIENZAS UNA NUEVA EXPERIENCIA DE ATENCIÓN DE CLIENTES</h3>
<fieldset class="login">
    <legend class="text-left">INICIA AHORA</legend>
    {{ Form::open(array('url' => 'login','role'=>'form', 'class'=> '')); }}
    <div class="form-group">
        <div class="col-xs-6 col-md-6">
            {{ Form::label('rut','Email o RUT', array('class' => '')); }}
            {{ Form::text('rut',Input::old('rut'),array('placeholder' => 'Email o RUT', 'class' => 'form-control input-lg')); }}
            <span class="help-block">{{ $errors->first('rut'); }}</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-6 col-md-6">
            {{ Form::label('password','Contraseña', array('class' => '')); }}
            {{ Form::password('password',array('placeholder' => 'Contraseña', 'class' => 'form-control input-lg')); }}
            <span class="help-block">{{ $errors->first('password'); }}</span>
        </div>
    </div>
    <div class="remember text-right">
        <a href="/user/forgot_password" class="">Olvidé mi contraseña</a>
    </div>
    <div class="col-md-6">
        {{ Form::submit('INICIA SESIÓN', array('class' => 'btn btn-primary btn-lg')); }}
    </div>
    <div class="col-md-6">
        {{ HTML::link('/user/signin', 'REGÍSTRATE', array('class' => 'btn btn-default btn-lg')); }}
    </div>
    {{ Form::close(); }}
</fieldset>

<button type="button" class="btn3d btn btn-default btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
<button type="button" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-cloud"></span> Upload</button>
<button type="button" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-ok"></span> Success</button>
<button type="button" class="btn btn-info btn-lg btn3d"><span class="glyphicon glyphicon-question-sign"></span> Help</button>
<button type="button" class="btn btn-warning btn-lg btn3d"><span class="glyphicon glyphicon-warning-sign"></span> Alert</button>
<button type="button" class="btn btn-danger btn-lg btn3d"><span class="glyphicon glyphicon-remove"></span> Delete</button>
@stop

@section('style')
<style>
    legend {
        margin-bottom: 0;
    }
</style>
@stop