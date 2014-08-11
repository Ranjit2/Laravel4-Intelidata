@extends('layouts.basic')

@section('title', 'Home')

@section('content')
<div class="page-header">
	<h1 id="timeline">LINEA DE TIEMPO</h1>
</div>
<ul class="timeline">
	<!-- LEFT -->
	<li>
		<div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<!-- RIGHT -->
	<li class="timeline-inverted">
		<div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<!-- LEFT -->
	<li>
		<div class="timeline-badge danger"><i class="glyphicon glyphicon-credit-card"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<!-- RIGHT -->
	<li class="timeline-inverted">
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<!-- LEFT -->
	<li>
		<div class="timeline-badge info"><i class="glyphicon glyphicon-floppy-disk"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<li>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
	<!-- RIGHT -->
	<li class="timeline-inverted">
		<div class="timeline-badge success"><i class="glyphicon glyphicon-thumbs-up"></i></div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">FIN FACTURACIÓN</h4>
				<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> FECHA</small></p>
			</div>
			<div class="timeline-body">
				<p>MONTO</p>
			</div>
		</div>
	</li>
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