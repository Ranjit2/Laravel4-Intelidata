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
<canvas id="myChart" width="800"></canvas>
@stop

@section('script')
var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};
var ctx = document.getElementById("myChart").getContext("2d");
var myLineChart = new Chart(ctx).Line(data);
@stop
