@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				{{ Form::select('types', $types, '', array('class' => 'types')); }}
				<div class="tiny-timeline text-center">
					<div class="col-md-10 col-xs-12">
						{{ HTML::tiny_timeline('#') }}
					</div>
				</div>
				<div class="clearfix"></div>
				<h3 class="title-chart text-center">{{ Func::convNumberToMonth(Carbon::now()->month) }} </h3>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
				<div class="col-md-12">
					<div id="legenddiv" style="min-height: 40px;"></div>
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
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};
	var d  = '{{ Carbon::now()->toDateString() }}';
	var t  = $('h3.title-chart').text();
	var p  = $('.types').val();
	var pt = $('.types option:selected').text();

	$('h3.title-chart').text(pt+' - '+t);

	$.loadChart('chartdiv','/postTelefonosPorProducto/'+id+'/'+p,'telefonosPorProducto', d);

	$('.tiny-timeline a').on('click', function (e) {
		e.preventDefault();
		t = $(this).text();
		$('h3.title-chart').text(pt+' - '+t);
		d = $(this).attr('data-timeline');
		$.loadChart('chartdiv','/postTelefonosPorProducto/'+id+'/'+p,'telefonosPorProducto', d);
	});

	$('.types').on('change', function (e) {
		e.preventDefault();
		pt = $('option:selected', this).text();
		$('h3.title-chart').text(pt+' - '+t);
		p  = $(this).val();
		$.loadChart('chartdiv','/postTelefonosPorProducto/'+id+'/'+p,'telefonosPorProducto', d);
	});

	$('#generaexcel').on('click', function (e) {
		$(this).attr({'href': '/excelMontosDetalle/'+id+'/'+d+'/'+t});
	});
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop