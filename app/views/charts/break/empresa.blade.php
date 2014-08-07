@extends('layouts.basic')

@section('breadcrumb')
@parent
<li>{{ HTML::link('/charts', 'CHARTS') }}</li>
<li>{{ HTML::link('/enterprise', 'ENTERPRISE') }}</li>
<li>{{ HTML::link('/break', 'BREAKCHART') }}</li>
<li class="active">DATA</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Title</h4>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, mollitia incidunt ipsa unde alias assumenda laboriosam delectus qui eos iure.</p>
				<div class="row">
					<div class="col-md-12">
						<div id="chartdiv" style="min-height: 350px !important; margin: 20px;"></div>
					</div>
					<div class="col-md-12">
						<div id="legenddiv"></div>
					</div>
					<div class="col-md-12">
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
</div>
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
	$.graficoBroken('chartdiv','/telefonosServicios/'+id+'/2014-05-25','post');
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop