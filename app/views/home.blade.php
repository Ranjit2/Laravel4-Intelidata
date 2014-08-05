@extends('layouts.basic')

@section('title', 'Home')

@section('header')
@parent
@stop

@section('content')
<h4>Sitema de estadisticas y visualización de datos.</h4>
<div id="chartdiv7" style="min-height: 500px;"></div>
<div id="legenddiv"></div>
<ul class="lista"></ul>
@stop


@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
    var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
    $.graficoBroken('chartdiv7','/telefonosServicios/'+id+'/2014-03-25','post');

</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop