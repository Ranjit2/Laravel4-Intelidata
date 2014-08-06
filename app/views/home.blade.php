@extends('layouts.basic')

@section('title', 'Home')

@section('header')
<h2>Bienvenido {{ Session::get('ses_user_rut') }}</h2>
@stop

@section('content')
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