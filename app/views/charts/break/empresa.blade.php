@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="tiny-timeline text-center">
					{{ HTML::tiny_timeline('#') }}
				</div>
				<div class="clearfix"></div>
				<h3 class="title-chart text-center">{{ Func::convNumberToMonth(Carbon::now()->month) }}</h3>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
				<div class="col-md-12">
					<div id="legenddiv" style="min-height: 40px;"></div>
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
AmCharts.ready(function () {
	$.graficoBroken('chartdiv','/telefonosServicios/'+id+'/{{ Carbon::now() }}','post');
	$('.tiny-timeline a').on('click', function (e) {
		e.preventDefault();
		var d = $(this).attr('data-timeline');
		var t = $(this).text();
		$('h3.title-chart').text(t);
		$.graficoBroken('chartdiv','/telefonosServicios/'+id+'/'+d,'post');
	});
});
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop