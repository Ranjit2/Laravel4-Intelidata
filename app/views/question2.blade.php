@extends('layouts.dashboard')

@section('content')
{{ HTML::genera_contacto($preguntas) }}
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




