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
</div>
@stop


@section('aside')

@stop


@section('script')
<script type="text/javascript">
var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop