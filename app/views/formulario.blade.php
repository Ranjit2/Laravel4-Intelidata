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
<div id="chartdiv2" style="width: 100%; height: 400px;"></div>
 <div id="chartdiv" style="width: 100%; height: 300px;"></div>
@stop

<style type="text/css">
/*#chartdiv {
background: #3f3f4f;
color:#ffffff;
width       : 100%;
height      : 500px;
font-size   : 11px;
}*/
</style>

@section('script')


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
    "legend": {
        "autoMargins": false,
        "borderAlpha": 0.8,
        "equalWidths": true,
        "horizontalGap": 10,
        "markerSize": 10,
        "useGraphSettings": true,
        "valueAlign": "left",
        "align": "center",
        "valueWidth": 0,
    },
    "graphs": [
    {
        "id": "AmGraph-1",
        "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 1,
        "lineAlpha": 1,
        "title": "Telefonía",
        "type": "column",
        "valueField": "Telefonia"
    },
    {
        "id": "AmGraph-2",
        "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 1,
        "lineAlpha": 1,
        "title": "Internet",
        "type": "column",
        "valueField": "Internet"
    },
    {
        "id": "AmGraph-3",
        "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 1,
        "lineAlpha": 1,
        "title": "Televisión",
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

@stop