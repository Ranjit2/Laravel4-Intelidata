@extends('layouts.basic')
@section('login')
{{ Form::open(array('url' => 'envioForm','role'=>'form')) }}
	<div class="form-group">
    {{Form::label('name','Username: ')}}
    {{Form::text('username',Input::old('username'),array('class' => 'form-control'))}}
    {{$errors->first('username');}}
    </div>
    <div class="form-group">
    {{Form::label('password','Password: ')}}
    {{Form::password('password',array('class' => 'form-control'))}}
    {{$errors->first('password');}}
    </div>
	<div class="form-group">
	{{Form::label('email','Email: ')}}
    {{Form::email('email','',array('class' => 'form-control'))}}
    {{$errors->first('email');}}
    </div>
    <div class="form-group">
    {{Form::label('activo','Activo: ')}}
    {{Form::checkbox('activo', 'value', true)}}
    </div>
    {{Form::submit('Click Me!',array('class'=>'btn btn-default'))}}
{{ Form::close() }}
@stop

@section('content')
<!-- <canvas id="myChart" width="400" height="400"></canvas> -->
<div class="row">
    <div class="col-md-9">
        <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-3">
        <div id="barLegend" ></div>
    </div>
</div>
@stop

<style type="text/css">
  
    #chartdiv {
        /*background: #3f3f4f;color:#ffffff;   */
    width       : 100%;
    height      : 500px;
    font-size   : 11px;
    }
    
</style>

<div id="chartdiv" style="width: 100%; height: 400px;"></div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="js/amcharts_3.10.0.free/images/style.css" type="text/css">
    <script src="js/amcharts_3.10.0.free/amcharts/amcharts.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/dark.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/black.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/exporting/amexport_combined.js"></script>

    

    <script type="text/javascript">
        var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
        "categoryField": "year",
        "rotate": false,
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start",
            "position": "left"
        },
        "trendLines": [],
        "graphs": [
            {
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 0.8,
                "id": "AmGraph-1",
                "lineAlpha": 0.2,
                "title": "Telefonia",
                "type": "column",
                "valueField": "Telefonia"
            },
            {
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 0.8,
                "id": "AmGraph-2",
                "lineAlpha": 0.2,
                "title": "Internet",
                "type": "column",
                "valueField": "Internet"
            },
            {
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",

                "fillAlphas": 0.8,
                "id": "AmGraph-3",
                "lineAlpha": 0.2,
                "title": "Television",
                "type": "column",
                "valueField": "Television"
            }

        ],
        "guides": [],
        "valueAxes": [
            {
                "id": "ValueAxis-1",
                "position": "left",
                "axisAlpha": 0
            }
        ],
        "allLabels": [],
        "amExport": {
            "right": 20,
            "top": 20
        },
        "balloon": {},
        "titles": [],
        "dataProvider": [
            {
                "year": "Enero",
                "Telefonia": 23.5,
                "Television": 18.1,
                "Internet": 15
            },
            {
                "year": "Febrero",
                "Telefonia": 23.5,
                "Internet": 17.1,
                "Television": 16
            },
            {
                "year": "Marzo",
                "Telefonia": 30.5,
                "Internet": 40.1,
                "Television": 20
            },
            {
                "year": "Abril",
                "Telefonia": 26.5,
                "Internet": 30.1,
                "Television": 31
            },
            {
                "year": "Mayo",
                "Telefonia": 33.5,
                "Internet": 38.1,
                "Television": 27
           }
        ],
        "legend": {
            "autoMargins": false,
            "borderAlpha": 0.2,
            "equalWidths": false,
            "horizontalGap": 10,
            "markerSize": 10,
            "useGraphSettings": true,
            "valueAlign": "left",
            "align": "center",
            "valueWidth": 0
        },
        "pathToImages":"http://www.amcharts.com/lib/3/images/",
        "amExport":{
         "top":21,
          "right":20,
          "exportJPG":true,
          "exportPNG":true,
          "exportSVG":true,
          "exportPDF":true
        }
    });
</script>


