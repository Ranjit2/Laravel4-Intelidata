@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3 class="title-chart text-center">Evolutivo</h3>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
				<div class="col-md-12">
					<div id="legenddiv" style="min-height: 40px;"></div>
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
	AmCharts.ready(function () {
		var chartData = generateChartData();
		var chart = AmCharts.makeChart("chartdiv", {
			"type": "serial",
			"theme": "none",
			"language": "es",
			"pathToImages": "http://www.amcharts.com/lib/3/images/",
			"dataProvider": chartData,
			"valueAxes": [{
				"axisAlpha": 0.2,
				"dashLength": 1,
				"position": "left"
			}],
			"mouseWheelZoomEnabled":true,
			"graphs": [{
				"id":"g1",
				"balloonText": "[[category]]<br /><b><span style='font-size:14px;'>Monto: $[[value]]</span></b>",
				"bullet": "round",
				"bulletBorderAlpha": 1,
				"bulletColor":"#FFFFFF",
				"hideBulletsCount": 50,
				"title": "red line",
				"valueField": "visits",
				"useLineColorForBulletBorder":true
			}],
			"chartScrollbar": {
				"autoGridCount": true,
				"graph": "g1",
				"scrollbarHeight": 40
			},
			"chartCursor": {
				"cursorPosition": "mouse"
			},
			"categoryField": "date",
			"categoryAxis": {
				"parseDates": true,
				"axisColor": "#DADADA",
				"dashLength": 1,
				"minorGridEnabled": true
			},
			"exportConfig":{
				menuRight: '20px',
				menuBottom: '30px',
				menuItems: [{
					icon: 'http://www.amcharts.com/lib/3/images/export.png',
					format: 'png'
				}]
			}
		});

chart.addListener("rendered", zoomChart);
zoomChart();

function zoomChart() {
	chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
}

function generateChartData() {
	var chartData = [];
	var firstDate = new Date();
	firstDate.setDate(firstDate.getDate() - 5);

	for (var i = 0; i < 1000; i++) {

		var newDate = new Date(firstDate);
		newDate.setDate(newDate.getDate() + i);

		var visits = Math.round(Math.random() * (40 + i / 5)) + 20 + i;

		chartData.push({
			date: newDate,
			visits: visits
		});
	}
	return chartData;
}
});
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop