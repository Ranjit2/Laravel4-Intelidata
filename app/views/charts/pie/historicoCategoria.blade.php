@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="#" id="generaexcel"><i class="fa fa-file-excel-o fa-2x"></i></a>
				<div class="tiny-timeline text-center">
					{{ HTML::tiny_timeline('#') }}
				</div>
				<div class="clearfix"></div>
				<h3 class="title-chart text-center">{{ Func::convNumberToMonth(Carbon::now()->month) }}</h3>
				<div class="col-md-12">
					<div id="chartdiv" style="min-height: 350px !important;"></div>
				</div>
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
	var d  = '{{ Carbon::now()->toDateString() }}';
	var t  =  $('h3.title-chart').text();

	$.loadChart('chartdiv','/grafHistoricoCategoria/'+id+'/{{ Carbon::now()->toDateString() }}','historicoCategoria');

	$('.tiny-timeline a').on('click', function (e) {
		e.preventDefault();
		d = $(this).attr('data-timeline');
		t = $(this).text();
		$('h3.title-chart').text(t);
		$.loadChart('chartdiv','/grafHistoricoCategoria/'+id+'/'+d,'historicoCategoria');
	});
	$('#generaexcel').on('click', function () {
		//e.preventDefault();
		$(this).attr({'href': '/excelHistoricoCategoria/'+id+'/'+d+'/'+t});
	});

</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop