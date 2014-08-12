@extends('layouts.basic')

@section('title', 'Home')

@section('content')
<div class="page-header">
	<h1 id="timeline">LINEA DE TIEMPO</h1>
</div>
<ul class="timeline">
	{{ HTML::timeline($tline) }}
</ul>
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop