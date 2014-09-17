@extends('layouts.dashboard')

@section('title', 'Histórico por categorías')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2 class="text-center">Histórico por categorías</h2>
				<div class="pull-right">
					<div class="pull-right">
						<a href="#" id="generaexcel"><i class="fa fa-file-excel-o fa-2x"></i></a>
						<a href="#" class = "buttonExport" id="btnPDF" title="exportar a pdf"><i class="fa fa-file-pdf-o fa-2x"></i></a>
						<a href="#" class = "buttonExport" id="btnPNG" title="exportar a PNG"><i class="fa fa-file-image-o fa-2x"></i></a>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					{{ HTML::tiny_timeline('#') }}
				</div>
				<h3 class="title-chart text-center">{{ Func::convNumberToMonth(Carbon::now()->month) }}</h3>
				<div class="col-md-12">
					<div id="error" style="display: none;">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Ops!</strong> No hay datos disponibles ...
						</div>
					</div>
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
	var t  =  $('h3.title-chart').text();

	$.loadChart('chartdiv','/grafHistoricoCategoria/'+id+'/{{ Carbon::now()->toDateString() }}','historicoCategoria');

	$('.tiny-timeline a').on('click', function (e) {
		e.preventDefault();
		d = $(this).attr('data-timeline');
		t = $(this).attr('data-name');
		$('h3.title-chart').text(t);
		$.loadChart('chartdiv','/grafHistoricoCategoria/'+id+'/'+d,'historicoCategoria');
	});

	$('.dates').on('change', function (e) {
		e.preventDefault();
		t = $('option:selected', this).text();
		$('h3.title-chart').text(t);
		d  = $(this).val();
		console.log(t);
		$.loadChart('chartdiv','/grafHistoricoCategoria/'+id+'/'+d,'historicoCategoria');
	});

	$('#generaexcel').on('click', function (e) {
		$(this).attr({'href': url_developer+'/excelHistoricoCategoria/'+id+'/'+d+'/'+t});
	});

</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop