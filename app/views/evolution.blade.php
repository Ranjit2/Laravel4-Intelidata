@extends('layouts.dashboard')

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
					<!-- .col-md-12>table.data_general>(thead>tr>th*2)+(tbody>tr>th*2) -->
					<table class="data_general table table-condensed table-hover">
						<thead>
							<tr>
								<th>Total</th>
								<th>Promedio</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>$2.500.000</th>
								<th>54%</th>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>ASD</th>
								<th>FGH</th>
							</tr>
						</tfoot>
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
	var lineChartData = {{ $data }};
	var year1 = {{ $year[0] }};
	var year2 = {{ $year[1] }};
	var year3 = {{ $year[2] }};

	AmCharts.ready(function () {
			var chart                    = new AmCharts.AmSerialChart();
			chart.dataProvider           = lineChartData;
			chart.pathToImages           = "http://www.amcharts.com/lib/3/images/";
			chart.categoryField          = "date";
			chart.language               = "es";
			chart.numberFormatter        = [
				decimalSeparator   = ",",
				thousandsSeparator = ".",
				precision          = -1,
				];
			chart.autoMargins            = false;
			chart.marginRight            = 0;
			chart.marginLeft             = 75;
			chart.marginBottom           = 20;
			chart.marginTop              = 20;

			var categoryAxis             = chart.categoryAxis;
			categoryAxis.inside          = false;
			categoryAxis.gridAlpha       = 0;
			categoryAxis.tickLength      = 0;
			categoryAxis.axisAlpha       = 0;

			var valueAxis                = new AmCharts.ValueAxis();
			valueAxis.dashLength         = 1;
			valueAxis.axisColor          = "#DADADA";
			valueAxis.axisAlpha          = 1;
			valueAxis.unit               = "$";
			valueAxis.unitPosition       = "left";
			chart.addValueAxis(valueAxis);

			var legend                   = new AmCharts.AmLegend();
			legend.labelText             = "[[title]]";
			legend.valueText             = "";
			legend.useGraphSettings      = true;
			chart.addLegend(legend, "legenddiv");

			var graph                    = new AmCharts.AmGraph();
			graph.title                  = year1;
			graph.balloonText            = "<strong>[[date]] - [[year1]]</strong> <br>Monto: $[[value]]";
			graph.type                   = "line";
			graph.valueField             = "val1";
			graph.lineColor              = "#60c6cf";
			graph.lineThickness          = 3;
			graph.bullet                 = "round";
			graph.bulletColor            = "#60c6cf";
			graph.bulletBorderColor      = "#ffffff";
			graph.bulletBorderAlpha      = 1;
			graph.bulletBorderThickness  = 3;
			graph.bulletSize             = 12;
			chart.addGraph(graph);

			var graph1                   = new AmCharts.AmGraph();
			graph1.title                 = year2;
			graph1.balloonText           = "<strong>[[date]] - [[year2]]</strong> <br>Monto: $[[value]]";
			graph1.type                  = "line";
			graph1.valueField            = "val2";
			graph1.lineColor             = "#f35958";
			graph1.lineThickness         = 3;
			graph1.bullet                = "round";
			graph1.bulletColor           = "#f35958";
			graph1.bulletBorderColor     = "#ffffff";
			graph1.bulletBorderAlpha     = 1;
			graph1.bulletBorderThickness = 3;
			graph1.bulletSize            = 12;
			chart.addGraph(graph1);

			var graph2                   = new AmCharts.AmGraph();
			graph2.title                 = year3;
			graph2.balloonText           = "<strong>[[date]] - [[year3]]</strong> <br>Monto: $[[value]]";
			graph2.type                  = "line";
			graph2.valueField            = "val3";
			// graph2.lineColor          = "#f35958";
			graph2.lineThickness         = 3;
			graph2.bullet                = "round";
			// graph2.bulletColor        = "#f35958";
			graph2.bulletBorderColor     = "#ffffff";
			graph2.bulletBorderAlpha     = 1;
			graph2.bulletBorderThickness = 3;
			graph2.bulletSize            = 12;
			chart.addGraph(graph2);

			var chartCursor              = new AmCharts.ChartCursor();
		chart.addChartCursor(chartCursor);

		chart.write("chartdiv");
	});
</script>
@stop
