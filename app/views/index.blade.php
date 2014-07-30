@extends('layouts.login')
@section('content')
<div class="jumbotron">
    <div class="container">
        <span class="fa fa-bar-chart-o"></span>
        <h2>Stats</h2>
        {{ $errors->first('rut'); }}<br>
        {{ $errors->first('password') }}
        {{ Form::open(array('url' => 'login','role'=>'form')) }}
        {{ Form::label('rut','Rut: ', array('class' => 'sr-only')) }}
        {{ Form::text('rut',Input::old('rut'),array('placeholder' => 'RUT', 'class' => 'form-control')) }}
        {{ Form::label('password','Password: ', array('class' => 'sr-only')) }}
        {{ Form::password('password',array('placeholder' => 'Password', 'class' => 'form-control')) }}
        <button class="btn btn-default full-width btn-block"><span class="glyphicon glyphicon-ok"></span></button>
        {{ Form::close() }}
    </div>
</div>
@stop