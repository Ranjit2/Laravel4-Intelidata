@extends('layouts.basic')

@section('breadcrumb')
@parent
<li>{{ HTML::link('/charts', 'CHARTS') }}</li>
<li>{{ HTML::link('/enterprise', 'ENTERPRISE') }}</li>
<li>{{ HTML::link('/break', 'BREAKCHART') }}</li>
<li class="active">DATA</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Title</h4>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, mollitia incidunt ipsa unde alias assumenda laboriosam delectus qui eos iure.</p>
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
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : '111-1' }};
</script>

@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop