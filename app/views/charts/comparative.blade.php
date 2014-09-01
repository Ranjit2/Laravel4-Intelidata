@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="title-chart text-center">Gráfico comparativo</h3>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 450px !important;"></div>
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
	$.loadChart('chartdiv','/postChartComparative/'+id, 'comparative');
</script>
@stop
