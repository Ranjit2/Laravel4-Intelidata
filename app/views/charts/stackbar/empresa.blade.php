@extends('layouts.basic')

@section('breadcrumb')
@parent
<li>{{ HTML::link('/charts', 'CHARTS') }}</li>
<li>{{ HTML::link('/enterprise', 'ENTERPRISE') }}</li>
<li>{{ HTML::link('/stackbar', 'STACKBAR') }}</li>
<li class="active">DATA</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div id="chartdiv5" style="height: 400px;"></div>
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