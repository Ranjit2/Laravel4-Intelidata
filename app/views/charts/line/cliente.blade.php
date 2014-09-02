@extends('layouts.dashboard')

@section('aside')
@parent
@stop

@section('content')
<h2 class="text-center">Evolución de mis gastos</h2>
<div id="chartdiv" style="with: 100%; height: 500px;"></div>
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