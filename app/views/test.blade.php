@extends('layouts.dashboard')

@section('content')
<div id="chartdiv" style="min-height: 350px !important;"></div>
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};


	$.loadChart('chartdiv','/prueba/'+id+'/{{ Carbon::now()->toDateString() }}','historicoCategoria');

	


</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop