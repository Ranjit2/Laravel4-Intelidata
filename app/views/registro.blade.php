

@extends('layouts.two_column')
@section('content')
{{ $errors->first('nombre'); }}<br>
{{ $errors->first('apellidos') }}<br>
{{ $errors->first('rut') }}<br>
{{ $errors->first('password') }}<br>
{{ $errors->first('rePassword') }}<br>
<fieldset>
	<legend>REGISTRO</legend>
	{{ Form::open(array('url' => 'registro','role'=>'form')) }}
	<div class="form-group">
		<div class="col-md-6">
			{{ Form::text('nombre',Input::old('nombre'),array('placeholder' => 'NOMBRE', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			{{ Form::text('apellidos',Input::old('apellidos'),array('placeholder' => 'APELLIDOS', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			{{ Form::email('email',Input::old('email'),array('placeholder' => 'E-MAIL', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			{{ Form::text('rut',Input::old('rut'),array('placeholder' => 'RUT', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			{{ Form::password('password',array('placeholder' => 'CONTRASEÑA', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6" >
			{{ Form::password('rePassword',array('placeholder' => 'REPITA CONTRASEÑA', 'class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6"  style="margin-top: 10px;">
			<button class="btn btn-default">Registrate</button>
		</div>
	</div>
	{{ Form::close() }}
</fieldset>
@stop
