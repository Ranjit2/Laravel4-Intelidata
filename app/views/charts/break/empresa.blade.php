@extends('layouts.basic')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="tiny-timeline text-center">
					<ul class="list-inline">
						@for ($i = 13; $i > 0; $i--)
						@if (Carbon::now()->subMonths($i)->month == 1)
						|
						@endif
						<li><a href="#" data-timeline="1/{{ Carbon::now()->subMonths($i)->month }}/{{ Carbon::now()->subMonths($i)->year }}">{{ Carbon::now()->subMonths($i)->month }}-{{ Carbon::now()->subMonths($i)->year }}</a></li>
						@endfor
					</ul>
				</div>
				<h4>Title</h4>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
				<div class="col-md-12">
					<div id="legenddiv"></div>
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

	$('.selectpicker').selectpicker();
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop