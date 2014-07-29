@extends('layouts.basic')
@section('login')
<!-- LOGOUT BUTTON -->
<a href="{{ URL::to('logout') }}">Logout</a>
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
    <div id="chartdiv" class="col-md-4" style="height: 400px;"></div>
    <div id="chartdiv2" class="col-md-4" style="height: 400px;"></div>
    <div id="chartdiv3" class="col-md-4" style="height: 400px;"></div>
</div>
<div class="row">
    <div id="chartdiv4" class="col-md-12" style="height: 400px;"></div>
</div>
<div class="row">
    <div id="chartdiv5" class="col-md-12" style="height: 400px;"></div>
    <div id="chartdiv6" class="col-md-12" style="height: 400px;"></div>
</div>
@stop

@section('script')
@stop