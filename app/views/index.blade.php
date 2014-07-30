@extends('layouts.login')
@section('content')
<div class="jumbotron">
    <div class="container">
        <span class="fa fa-bar-chart-o"></span>
        <h2><span>i</span>Data</h2>
        {{ $errors->first('rut'); }}<br>
        {{ $errors->first('password') }}
        {{ Form::open(array('url' => 'login','role'=>'form')) }}
        {{ Form::label('rut','RUT ', array('class' => 'sr-only')) }}
        {{ Form::text('rut',Input::old('rut'),array('placeholder' => 'RUT', 'class' => 'form-control')) }}
        {{ Form::label('password','CONTRASEÑA ', array('class' => 'sr-only')) }}
        {{ Form::password('password',array('placeholder' => 'CONTRASEÑA', 'class' => 'form-control')) }}
        <button class="btn btn-default full-width btn-block"><span class="glyphicon glyphicon-ok"></span></button>
        {{ Form::close() }}
    </div>
</div>
@stop