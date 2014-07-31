@extends('layouts.basic')

@section('header')
<header class="clearfix">
    <ul class="list-inline">
        <li>
            <h2 class="main-header__title">
                <i class="icon pe-7s-graph"></i>
                Statistics <small>Charts &amp; graphs</small>
            </h2>
        </li>
        <li>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Statistics</a></li>
                <li class="active">Data</li>
            </ol>
        </li>
        <li>
            <div>
                <i class="icon pe-7s-date"></i>
                <span>{{ Carbon::now()->format('l jS \\of F Y h:i:s A') }}</span>
                <i class="pe-7s-angle-down-circle"></i>
            </div>
        </li>
    </ul>
</header>
@stop

@section('content')
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
        @parent
@stop


@section('script')
<script type="text/javascript">
    var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
</script>
@stop