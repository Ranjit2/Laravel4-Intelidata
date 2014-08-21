

@extends('layouts.two_column')
@section('content')

<fieldset>
	<legend>REGISTRO</legend>
	{{ Form::open(array('url' => 'registro','role'=>'form')) }}
	<div class="row">
		<div class="form-group">
			<div class="col-md-6">
				{{ Form::text('nombre',Input::old('nombre'),array('placeholder' => 'NOMBRE', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('nombre'); }}</span>
			</div>
			<div class="col-md-6">
				{{ Form::text('apellidos',Input::old('apellidos'),array('placeholder' => 'APELLIDOS', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('apellidos'); }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<div class="col-md-6">
				{{ Form::email('email',Input::old('email'),array('placeholder' => 'E-MAIL', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('email'); }}</span>
			</div>
			<div class="col-md-6">
				{{ Form::text('rut',Input::old('rut'),array('placeholder' => 'RUT', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('rut'); }}</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<div class="col-md-6">
				{{ Form::password('password',array('placeholder' => 'CONTRASEÑA', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('password'); }}</span>
			</div>
			<div class="col-md-6" >
				{{ Form::password('rePassword',array('placeholder' => 'REPITA CONTRASEÑA', 'class' => 'form-control')) }}
				<span class="help-block">{{ $errors->first('rePassword'); }}</span>
			</div>
		</div>
	</div>
	<button class="btn btn-default">Registrate</button>
	{{ Form::close() }}
</fieldset>
@stop
