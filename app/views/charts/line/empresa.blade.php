@extends('layouts.dashboard')

@section('content')
<div id="chartdiv" style="with: 100%; height: 500px;"></div>
@stop

@section('script')
<script type="text/javascript">
	var chart = AmCharts.makeChart("chartdiv", {
		"type": "serial",
		"theme": "none",
		"marginLeft": 20,
		"pathToImages": "http://www.amcharts.com/lib/3/images/",
		"dataProvider": [{
			"year": "1951-06-07",
			"value": 0.47
		}],
		"valueAxes": [{
			"axisAlpha": 0,
			"inside": true,
			"position": "left",
			"ignoreAxisWidth": true
		}],
		"graphs": [{
			"balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 6,
			"lineColor": "#d1655d",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"type": "smoothedLine",
			"valueField": "value"
		}],
		"chartCursor": {
			"categoryBalloonDateFormat": "YYYY-MM-DD",
			"cursorAlpha": 0,
			"cursorPosition": "mouse"
		},
		"dataDateFormat": "YYYY-MM-DD",
		"categoryField": "year",
		"categoryAxis": {
			"minPeriod": "MM",
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