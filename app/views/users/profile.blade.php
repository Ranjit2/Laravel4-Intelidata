@extends('layouts.basic')

@section('content')
<div class="profile">
	<form role="form">
		<h2>Editar Perfil <small></small></h2>
		<fieldset>
		<legend class="text-right" class="text-right" class="text-right">Personal</legend class="text-right" class="text-right">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<input type="text" name="direccion" id="direccion" class="form-control input-lg" placeholder="Direcci&oacute;n" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="fono" id="fono" class="form-control input-lg" placeholder="Tel&eacute;fono Fijo" tabindex="2">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="cel" id="cel" class="form-control input-lg" placeholder="Tel&eacute;fono Celular" tabindex="3">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail" tabindex="4">
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend class="text-right" class="text-right">Trabajo</legend>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<input type="text" name="direccion" id="direccion" class="form-control input-lg" placeholder="Direcci&oacute;n" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="fono" id="fono" class="form-control input-lg" placeholder="Tel&eacute;fono Fijo" tabindex="2">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="cel" id="cel" class="form-control input-lg" placeholder="Tel&eacute;fono Celular" tabindex="3">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail" tabindex="4">
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend class="text-right">Redes Sociales</legend>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="fono" id="fono" class="form-control input-lg" placeholder="Twitter" tabindex="2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="cel" id="cel" class="form-control input-lg" placeholder="Facebook" tabindex="3">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Skype" tabindex="4">
					</div>
				</div>
			</div>
		</fieldset>
		<input type="submit" value="GUARDAR" class="btn btn-primary btn-lg col-md-4" tabindex="7">
	</form>
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