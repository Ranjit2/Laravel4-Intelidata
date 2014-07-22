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
    <div class="col-md-12s" id="graff"></div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="alert alert-info info" style="display: none;">
            <ul></ul>
        </div>
    </div>
</div>
<div class="row">
    <!-- <a href="#" id="get">GET</a> -->
    <button class="btn btn-primary" id="get" data-toggle="modal" data-target="#modal">
        <span class="glyphicon glyphicon-star"></span>Large modal
    </button>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">HEADER</div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="mail"><span class="glyphicon glyphicon-envelope"></span> SEND EMAIL!</a>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="POST" id="post" role="form">
            <fieldset>
                <legend>Form post</legend>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="age">Age: </label>
                    <input type="text" name="age" id="age" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
    <div class="col-md-6">
        <form action="" method="POST" id="post2" role="form">
            <fieldset>
                <legend>Form post2</legend>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="age">Age: </label>
                    <input type="text" name="age" id="age" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
<!-- .row>.col-lg-12>.alert.alert-info.info[style="display: none;"]>ul -->
<div class="row">
    <div class="col-md-4">
        <form method="POST" id="fError" role="form">
            <fieldset>
                <legend>FormData ajax - Errors Feedback</legend>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name2" id="name2" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
@stop
@section('script')
$(function () {
    $('#graff').highcharts({
        chart: {
            type: 'column',
            marginRight: 100,
            marginBottom: 40
        },
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
         plotOptions: {
               column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        format: '{point.y:.1f}%'
                    }
                }
            },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 15,
                width: 2,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '$',
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: 0,
            y: 100,
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
            name: 'New York',
            data: [19.3, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
            name: 'Berlin',
            data: [1.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
});
@stop