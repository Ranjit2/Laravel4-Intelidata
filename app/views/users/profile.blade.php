@extends('layouts.dashboard')

@section('content')
<div class="profile">
	{{ Form::model($persona, array('role' => 'form', 'url' => array('/user/profile', $persona->id), 'method' => 'PUT')) }}
	<h2>Editar Perfil <small></small></h2>
	<fieldset>
		<legend class="text-right" class="text-right" class="text-right">Personal</legend>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					{{ Form::text('direccion_personal', Input::old('direccion_personal'), array('class' => 'form-control input-lg', 'id' => 'direccion_personal', 'placeholder' => 'Direcci&oacute;n')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('telefono_fijo_personal', Input::old('telefono_fijo_personal'), array('class' => 'form-control input-lg', 'id' => 'telefono_fijo_personal', 'placeholder' => 'Tel&eacute;fono Fijo')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('celular_personal', Input::old('celular_personal'), array('class' => 'form-control input-lg', 'id' => 'celular_personal', 'placeholder' => 'Tel&eacute;fono Celular')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('email_personal', Input::old('email_personal'), array('class' => 'form-control input-lg', 'id' => 'email_personal', 'placeholder' => 'E-mail')) }}

				</div>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend class="text-right" class="text-right">Trabajo</legend>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					{{ Form::text('direccion_work', Input::old('direccion_work'), array('class' => 'form-control input-lg', 'id' => 'direccion_work', 'placeholder' => 'Direcci&oacute;n')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('telefono_fijo_work', Input::old('telefono_fijo_work'), array('class' => 'form-control input-lg', 'id' => 'telefono_fijo_work', 'placeholder' => 'Tel&eacute;fono Fijo')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('celular_work', Input::old('celular_work'), array('class' => 'form-control input-lg', 'id' => 'celular_work', 'placeholder' => 'Tel&eacute;fono Celular')) }}
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('email_work', Input::old('email_work'), array('class' => 'form-control input-lg', 'id' => 'email_work', 'placeholder' => 'E-mail')) }}

				</div>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend class="text-right">Redes Sociales</legend>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('twitter', Input::old('twitter'), array('id' => 'twitter', 'class' => 'form-control input-lg', 'placeholder' => 'Twitter')) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('facebook', Input::old('facebook'), array('id' => 'facebook', 'class' => 'form-control input-lg', 'placeholder' => 'Facebook')) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
					{{ Form::text('skype', Input::old('skype'), array('id' => 'skype', 'class' => 'form-control input-lg', 'placeholder' => 'Skype')) }}
				</div>
			</div>
		</div>
	</fieldset>
	{{ Form::submit("GUARDAR", array('class' => 'btn btn-primary btn-lg col-md-4')) }}
	{{ Form::close() }}
</div>
@stop


@section('aside')
@parent
@stop


@section('script')
<script type="text/javascript">
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop