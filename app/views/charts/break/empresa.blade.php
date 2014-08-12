@extends('layouts.basic')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
<<<<<<< HEAD
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, mollitia incidunt ipsa unde alias assumenda laboriosam delectus qui eos iure.</p>
					<select class="selectpicker show-tick">
						@foreach ($titulares as $a)
							<option>{{$a->tipo}}</option>
						@endforeach
					</select>
=======
				<div class="tiny-timeline text-center">
					{{ HTML::timeline('#') }}
				</div>
				<h4>Title</h4>
>>>>>>> b82c4c138191edf401e36493d1eb2c7e2dbc2c92
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
				<div class="col-md-12">
					<div id="legenddiv" style="min-height: 40px; margin: 0 auto;"></div>
					<table id="lista" class="table table-condensed table-hover" style="display: none;">
						<thead>
							<tr style="font-size: 14px;">
								<th>Servicio</th>
								<th>Porcentaje</th>
								<th>Monto</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
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
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
	$.graficoBroken('chartdiv','/telefonosServicios/'+id+'/2014-08-25','post');
<<<<<<< HEAD
=======

>>>>>>> b82c4c138191edf401e36493d1eb2c7e2dbc2c92
	$('.selectpicker').selectpicker();
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop