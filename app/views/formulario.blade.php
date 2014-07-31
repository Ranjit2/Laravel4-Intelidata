@extends('layouts.basic')

@section('content')
<ol class="breadcrumb">
  <li><a href="#">Inicio</a></li>
  <li><a href="#">Estadisticas</a></li>
  <li class="active">Data</li>
</ol>

<h2>Stadistics</h2>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv" style="height: 200px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default"
        <div class="panel-body">
            <div id="chartdiv2" style="height: 200px;"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv3" style="height: 200px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv4" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv5" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv6" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="chartdiv7" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
@stop


@section('aside')

@stop


@section('script')
<script type="text/javascript">
    var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};

    //grafico
    var chart;
    var legend;
    var selected;

    var types = [{
        type: "84465285",
        percent: 50000, 
        color: "#ff9e01",
        subs: [
            { type: "servicio1", percent: 25000 },
            { type: "servicio2", percent: 10000 },
            { type: "servicio3", percent: 15000 }
        ]},
    {
        type: "86624454",
        percent: 100000,
        color: "#b0de09",
        subs: [
            { type: "servicio1", percent: 60000 },
            { type: "servicio2", percent: 15000 },
            { type: "servicio3", percent: 25000 }
        ]}
    ];

    function generateChartData () {
        var chartData = [];
        for (var i = 0; i < types.length; i++) {
            if (i == selected) {
                for (var x = 0; x < types[i].subs.length; x++) {
                    chartData.push({
                        type: types[i].subs[x].type,
                        percent: types[i].subs[x].percent,
                        color: types[i].color,
                        pulled: true
                    });
                }
            }
            else {
                chartData.push({
                    type: types[i].type,
                    percent: types[i].percent,
                    color: types[i].color,
                    id: i
                });
            }
        }
        return chartData;
    }

    AmCharts.ready(function() {
        // PIE CHART
        chart                  = new AmCharts.AmPieChart();
        chart.dataProvider     = generateChartData();
        chart.titleField       = "type";
        chart.valueField       = "percent";
        chart.outlineColor     = "#FFFFFF";
        chart.outlineAlpha     = 0.8;
        chart.outlineThickness = 2;
        chart.colorField       = "color";
        chart.pulledField      = "pulled";
        chart.type             = "serial";
        chart.balloonText      = "<b>[[percent]]</b>";
        chart.labelText        = "[[type]]";
        chart.radius           = "30%",
        
        
        // ADD TITLE
        chart.addTitle("ENERO");
        
        // AN EVENT TO HANDLE SLICE CLICKS
        chart.addListener("clickSlice", function (event) {
            if (event.dataItem.dataContext.id != undefined) {
                selected = event.dataItem.dataContext.id;
            }
            else {
                selected = undefined;
            }
            chart.dataProvider = generateChartData();
            chart.validateData();
        });

        // WRITE
        chart.write("chartdiv7");
    });


</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop

