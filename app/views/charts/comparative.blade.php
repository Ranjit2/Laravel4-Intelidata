@extends('layouts.dashboard')

@section('title', 'Gráfico comparativo')

@section('style')
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2 class="title-chart text-center">Gráfico comparativo</h2>
				<div class="pull-right">
					<a href="#" class = "buttonExport" id="btnPDF" title="exportar a pdf"><i class="fa fa-file-pdf-o fa-2x"></i></a>
					<a href="#" class = "buttonExport" id="btnPNG" title="exportar a PNG"><i class="fa fa-file-image-o fa-2x"></i></a>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					<div id="error" style="display: none;">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Ops!</strong> No hay datos disponibles ...
						</div>
					</div>
					<div id="chartdiv" style="min-height: 450px !important;"></div>
					<div id="legenddiv" style="min-height: 40px;"></div>
				</div>
			    <div class="col-md-12 table-responsive">
			        <table id="statics" class="table table-condensed table-hover">
			            <h3>Estadísticas</h3>
			            <caption>Porcentaje sobre variación monto total</caption>
			            <thead>
			                <tr>
			                    <th></th>
			                    <th>2013</th>
			                    <th>2014</th>
			                    <th>Variaci&oacute;n</th>
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
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};
	$.loadChart('chartdiv','/postChartComparative/'+id, 'comparative');
</script>
@stop
