@extends('layouts.dashboard')

@section('title', 'Histórico facturado')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2 class="text-center">Histórico facturado</h2>
				<div class="pull-right">
					<a href='{{ URL::to("/telefonoMontos") }}' title="exportar a excel"><i class="fa fa-file-excel-o fa-2x"></i></a>
					<a href="#" class = "buttonExport" id="btnPDF" title="exportar a pdf"><i class="fa fa-file-pdf-o fa-2x"></i></a>
					<a href="#" class = "buttonExport" id="btnPNG" title="exportar a PNG"><i class="fa fa-file-image-o fa-2x"></i></a>
				</div>
				<div class="clearfix"></div>
				<div id="error" style="display: none;">
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Ops!</strong> No hay datos disponibles ...
					</div>
				</div>
				<div id="chartdiv" style="min-height: 500px;"></div>
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
	$.loadChart('chartdiv', '/postSerialChartEnt/'+id, '', 'column');
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop