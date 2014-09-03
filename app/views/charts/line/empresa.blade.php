@extends('layouts.dashboard')

@section('aside')
@parent
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="title-chart text-center">Evolución de mis gastos</h3>
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

@section('script')
<script type="text/javascript">
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};
	$.loadChart('chartdiv','/postChartEvolution/'+id, 'evolution');
</script>
@stop

@section('style')
<style type="text/css">
</style>
@stop