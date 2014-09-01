@extends('layouts.dashboard')

@section('content')
@stop

@section('aside')
@parent
@stop

@section('script')
<script type="text/javascript">
console.log(foo); // bar
console.log(user); // User Obj
console.log(age); // 29
</script>
@stop

@section('style')
<style type="text/css" media="screen">
</style>
@stop