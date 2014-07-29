@extends('layouts.login')
@section('content')
<div class="jumbotron">
    <div class="container">
        <span class="fa fa-bar-chart-o"></span>
        <h2>Stats</h2>
        {{ $errors->first('username'); }}<br>
        {{ $errors->first('password') }}
        {{ Form::open(array('url' => 'login','role'=>'form')) }}
        {{ Form::label('username','Username: ', array('class' => 'sr-only')) }}
        {{ Form::text('username',Input::old('Username'),array('placeholder' => 'Username', 'class' => 'form-control')) }}
        {{ Form::label('password','Password: ', array('class' => 'sr-only')) }}
        {{ Form::password('password',array('placeholder' => 'Password', 'class' => 'form-control')) }}
        <button class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
        {{ Form::close() }}
    </div>
</div>
@stop