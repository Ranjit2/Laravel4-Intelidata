@extends('layouts.basic')
@section('login')
{{ Form::open(array('url' => 'envioForm','role'=>'form')) }}
<div class="form-group">
    {{ Form::label('name','Username: ') }}
    {{ Form::text('username',Input::old('username'),array('class' => 'form-control')) }}
    {{ $errors->first('username'); }}
</div>
<div class="form-group">
    {{ Form::label('password','Password: ') }}
    {{ Form::password('password',array('class' => 'form-control')) }}
    {{ $errors->first('password'); }}
</div>
<div class="form-group">
	{{ Form::label('email','Email: ') }}
    {{ Form::email('email','',array('class' => 'form-control')) }}
    {{ $errors->first('email'); }}
</div>
<div class="form-group">
    {{ Form::label('activo','Activo: ') }}
    {{ Form::checkbox('activo', 'value', true) }}
</div>
{{ Form::submit('Click Me!',array('class'=>'btn btn-default')) }}
{{ Form::close() }}

<h3>CHOICE YOUR CHART!: </h3>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" class="radioChart" id="r1" data-chart="Pie" value="donut" checked>
    Donut Chart
</label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="optionsRadios" class="radioChart" id="r2" data-chart="Pie" value="pie">
    Pie Chart
</label>
</div>
<div class="radio disabled">
  <label>
    <input type="radio" name="optionsRadios" class="radioChart" id="hide" data-chart="" value="hide" disabled>
    Hide Chart
</label>
</div>

@stop

@section('content')
<div class="row">
    <div id="chartdiv" style="with: 100%; height: 500px;"></div>
    <div id="chartdiv2" style="with: 100%; height: 500px;"></div>
</div>
<div class="row">
    <div id="chartdiv3" style="with: 100%; height: 500px;"></div>
</div>
@stop

@section('script')
@stop