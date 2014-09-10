@extends('layouts.two_column')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="text-left">REGISTRO DE USUARIOS</h3>
				<fieldset class="login">
					<legend>INGRESA TUS DATOS</legend>
					{{ Form::open(array('url' => 'registro','role'=>'form')) }}
					<div class="form-group">
						<div class="col-md-6">
							{{ Form::label('nombre','Nombre', array('class' => '')); }}
							{{ Form::text('nombre',Input::old('nombre'),array('placeholder' => 'Nombre', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('nombre'); }}</span>
						</div>
						<div class="col-md-6">
							{{ Form::label('apellidos','Apellidos', array('class' => '')); }}
							{{ Form::text('apellidos',Input::old('apellidos'),array('placeholder' => 'Apellidos', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('apellidos'); }}</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							{{ Form::label('email','Email', array('class' => '')); }}
							{{ Form::email('email',Input::old('email'),array('placeholder' => 'Email', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('email'); }}</span>
						</div>
						<div class="col-md-6">
							{{ Form::label('rut','RUT', array('class' => '')); }}
							{{ Form::text('rut',Input::old('rut'),array('placeholder' => 'RUT', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('rut'); }}</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							{{ Form::label('password','Contraseña', array('class' => '')); }}
							{{ Form::password('password',array('placeholder' => 'Contraseña', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('password'); }}</span>
						</div>
						<div class="col-md-6" >
							{{ Form::label('rePassword','Repita contraseña', array('class' => '')); }}
							{{ Form::password('rePassword',array('placeholder' => 'Repita contraseña', 'class' => 'form-control input-lg')) }}
							<span class="help-block">{{ $errors->first('rePassword'); }}</span>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-6" >
						{{ HTML::link('/home', 'VOLVER', array('class' => 'btn3d btn btn-default btn-lg')); }}
					</div>
					<div class="col-md-6" >
						{{ Form::submit('REGISTRATE', array('class' => 'btn3d btn btn-primary btn-lg')); }}
					</div>
					{{ Form::close() }}
				</fieldset>
			</div>
		</div>
	</div>
</div>
@stop
