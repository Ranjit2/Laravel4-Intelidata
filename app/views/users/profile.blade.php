@extends('layouts.basic')

@section('breadcrumb')
@parent
<li>{{ HTML::link('/user', 'USER') }}</li>
<li>{{ HTML::link('/profile', 'PROFILE') }}</li>
<li class="active">DATA</li>
@stop

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">{{ Session::get('ses_user_rut', '') }}</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
					<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
						<dl>
							<dt>DEPARTMENT:</dt>
							<dd>Administrator</dd>
							<dt>HIRE DATE</dt>
							<dd>11/12/2013</dd>
							<dt>DATE OF BIRTH</dt>
							<dd>11/12/2013</dd>
							<dt>GENDER</dt>
							<dd>Male</dd>
						</dl>
					</div>
					<div class=" col-md-9 col-lg-9 ">
						<table class="table table-user-information">
							<tbody>
								<tr>
									<td>Department:</td>
									<td>Programming</td>
								</tr>
								<tr>
									<td>Hire date:</td>
									<td>06/23/2013</td>
								</tr>
								<tr>
									<td>Date of Birth</td>
									<td>01/24/1988</td>
								</tr>
								<tr>
									<tr>
										<td>Gender</td>
										<td>Male</td>
									</tr>
									<tr>
										<td>Home Address</td>
										<td>Metro Manila,Philippines</td>
									</tr>
									<tr>
										<td>Email</td>
										<td><a href="mailto:info@support.com">info@support.com</a></td>
									</tr>
									<td>Phone Number</td>
									<td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
									</td>
								</tr>
							</tbody>
						</table>
						<a href="#" class="btn btn-primary">My Sales Performance</a>
						<a href="#" class="btn btn-primary">Team Sales Performance</a>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<a data-original-title="Enviar mensaje" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
				<span class="pull-right">
					<a href="#" data-original-title="Editar perfil " data-toggle="tooltip" type="button" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a>
					<a href="#" data-original-title="Eliminar perfil" data-toggle="tooltip" type="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></a>
				</span>
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
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop