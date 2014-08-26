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
	var chart = AmCharts.makeChart("chartdiv", {
		"type": "serial",
		"theme": "none",
		"language": "es",
		"marginLeft": 20,
		"pathToImages": "http://www.amcharts.com/lib/3/images/",
		"dataProvider": {{ $data }},
		"valueAxes": [{
			"axisAlpha": 0,
			"inside": false,
			"position": "left",
			"ignoreAxisWidth": false
		}],
		"graphs": [{
			"balloonText": "[[category]]<br><b><span style='font-size:14px;'>$ [[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 6,
			"lineThickness": 2,
			"type": "line",
			"valueField": "value"
		}],
		"chartCursor": {
			"cursorAlpha": 0,
			"cursorPosition": "mouse"
		},
		"dataDateFormat": "YYYY-MM-DD",
		"categoryField": "fecha",
		"categoryAxis": {
			"minPeriod": "MM",
			"groupToPeriods": ["MM"],
			"dateFormats": [
			{period:'MM',format:'MMMM'},
			{period:'YYYY',format:'YYYY'}
			],
			"parseDates": true,
			"minorGridAlpha": 0.1,
			"minorGridEnabled": true
		}
	});
</script>
@stop

@section('style')
<style type="text/css">
</style>
@stop