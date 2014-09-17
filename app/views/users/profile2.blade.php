@extends('layouts.two_column')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="profile">
					{{Form::open(array('role' => 'form', 'url' => array('/user/profile2')))}}
					<h2>Ingrese los datos de su perfil <small></small></h2>
					<fieldset>
						<legend class="text-left" class="text-right" class="text-right">Información personal</legend>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group has-feedback">
									{{ Form::text('direccion_personal', Input::old('direccion_personal'), array('class' => 'form-control input-lg', 'id' => 'direccion_personal', 'placeholder' => 'Direcci&oacute;n')) }}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('telefono_fijo_personal', Input::old('telefono_fijo_personal'), array('class' => 'form-control input-lg', 'id' => 'telefono_fijo_personal', 'placeholder' => 'Tel&eacute;fono Fijo')) }}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('celular_personal', Input::old('celular_personal'), array('class' => 'form-control input-lg', 'id' => 'celular_personal', 'placeholder' => 'Tel&eacute;fono Celular')) }}
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('email_personal', Input::old('email_personal'), array('class' => 'form-control input-lg', 'id' => 'email_personal', 'placeholder' => 'E-mail')) }}

								</div>
							</div>

						</div>
					</fieldset>
					<fieldset>
						<legend class="text-left">Redes Sociales</legend>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('twitter', Input::old('twitter'), array('id' => 'twitter', 'class' => 'form-control input-lg', 'placeholder' => 'Twitter')) }}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('facebook', Input::old('facebook'), array('id' => 'facebook', 'class' => 'form-control input-lg', 'placeholder' => 'Facebook')) }}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group has-feedback">
									{{ Form::text('skype', Input::old('skype'), array('id' => 'skype', 'class' => 'form-control input-lg', 'placeholder' => 'Skype')) }}
								</div>
							</div>
						</div>
					</fieldset>
						<div class="clearfix"></div>
						{{ HTML::link('/logout', 'VOLVER', array('class' => 'btn btn-primary btn-lg col-md-4')); }}
						{{ Form::submit("GUARDAR", array('class' => 'btn btn-primary btn-lg col-md-4 pull-right')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop


@section('aside')
@parent
@stop


@section('script')
<script type="text/javascript">

	$('input:text').each(function() {
		if ($.trim($(this).val()).length != 0) {
			$(this).parent().addClass('has-success').append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
		}
	});

	$('input:text').change(function() {
		if ($.trim($(this).val()).length != 0) {
			$(this).parent().addClass('has-success').append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
		} else if ($.trim($(this).val()).length == 0 ) {
			$(this).parent().removeClass('has-success');
			$(this).parent().find('span.form-control-feedback').remove();
		}
	});

</script>
@stop

@section('style')
<style type="text/css">
</style>
@stop