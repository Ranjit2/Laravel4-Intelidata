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
<div class="row">
<img src="" id="MyPix" style="display: none">
    <a href="#" id="pdf">Download PDF</a>
    <button onclick="putImage()">Save as Image</button>

</div>
<div class="row">
    <div class="col-md-9" id="chart">
        <h3>Historial Chart</h3>
        <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-3">
        <div id="barLegend" ></div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <h3>Donut Chart</h3>
        <canvas id="donutChart" with="400"></canvas>
    </div>
    <div class="col-md-3">
        <div id="donutLegend"></div>
    </div>
</div>
@stop

@section('script')

var data = {
    labels: {{ $labels }},
    datasets: {{ $histo }}
};

var ctx = $("#barChart").get(0).getContext("2d");
Chart.defaults.global.responsive = true;
var myLineChart = new Chart(ctx).Bar(data);
legend(document.getElementById("barLegend"), data);

var data = {{ $donut }};

var ctx2 = $("#donutChart").get(0).getContext("2d");
var myDoughnutChart = new Chart(ctx2).Doughnut(data);
legend(document.getElementById("donutLegend"), data);


@stop