@extends('layouts.login')
@section('content')

<div class="jumbotron">
    <div class="container">
        <span class="glyphicon glyphicon-stats"></span>
        <h2>Stats</h2>
        {{ $errors->first('username'); }}<br>
        {{ $errors->first('password') }}
        {{ Form::open(array('url' => 'login','role'=>'form')) }}
        {{ Form::label('username','Username: ', array('class' => 'sr-only')) }}
        {{ Form::text('username',Input::old('Username'),array('placeholder' => 'Username')) }}
        {{ Form::label('password','Password: ', array('class' => 'sr-only')) }}
        {{ Form::password('password',array('placeholder' => 'Password')) }}
        <button class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
        {{ Form::close() }}
    </div>
</div>

@stop
@section('style')
<style>
</style>
@stop

@section('script')
<script type="text/javascript">
</script>
@stop