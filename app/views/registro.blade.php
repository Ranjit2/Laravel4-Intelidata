<style>    
    .border-titulo{
        border-bottom: 3px solid;
    }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <div class="container">

        {{ $errors->first('rut'); }}<br>
        {{ $errors->first('password') }}
        {{ Form::open(array('url' => 'login','role'=>'form')) }}
	        <div class="row">
	        	<div class="col-md-6 pull-right">
	        		<h2 class="border-titulo"><strong>REGISTRO</strong></h2>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-4">

	           			{{ Form::text('nombre',Input::old('nombre'),array('placeholder' => 'NOMBRE', 'class' => 'form-control')) }}
	           	</div>
	           	<div class="col-md-4">
	        	   	{{ Form::text('apellidos',Input::old('apellidos'),array('placeholder' => 'APELLIDOS', 'class' => 'form-control')) }}
	        	</div>
	        </div>
	        <button class="btn btn-default full-width btn-block">Registrate</button>
        {{ Form::close() }}
</div>
