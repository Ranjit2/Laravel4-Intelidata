@extends('layouts.dashboard')

@section('title', 'Detalle por mes')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-xs-12 col-sm-12 col-md-12">
					{{ HTML::tiny_timeline('#') }}
				</div>
				<div class="clearfix"></div>
				<class="borde-titulo">Title</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, mollitia incidunt ipsa unde alias assumenda laboriosam delectus qui eos iure.</p>
				<div id="error" style="display: none;">
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Ops!</strong> No hay datos disponibles ...
					</div>
				</div>
				<div id="chartdiv7" style="height: 400px;"></div>
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
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop