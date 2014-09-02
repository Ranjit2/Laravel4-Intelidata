@extends('layouts.dashboard')

@section('content')
<<<<<<< HEAD
<div id="chartdiv" style="min-height: 350px !important;"></div>
=======
>>>>>>> origin/dev
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
<<<<<<< HEAD
	var id = {{ Session::has('ses_user_id') ? Session::get('ses_user_id') : 'NULL' }};


	$.loadChart('chartdiv','/prueba/'+id+'/{{ Carbon::now()->toDateString() }}','historicoCategoria');

	


=======
console.log(foo); // bar
console.log(user); // User Obj
console.log(age); // 29
>>>>>>> origin/dev
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop