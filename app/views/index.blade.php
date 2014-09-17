@extends('layouts.two_column')

@section('title', 'Login')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
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
        {{ HTML::link('/registro', 'REGÍSTRATE', array('class' => 'btn3d btn btn-primary btn-lg')); }}
    </div>
    <div class="col-md-6">
        {{ Form::submit('INICIA SESIÓN', array('class' => 'btn3d btn btn-primary btn-lg')); }}
    </div>
    {{ Form::close(); }}
</fieldset>
</div>
</div>
</div>
</div>
@stop

@section('style')
<style>
    legend {
        margin-bottom: 0;
    }
</style>
@stop