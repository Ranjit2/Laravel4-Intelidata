@extends('velocity::layout')

@section('title')
{{ $title }} 
@stop

@section('content')
	<br >
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ul class="list-group">
				<li class="list-group-item">
					Total Record 
					<span class="badge">{{ $total_record }}</span>
				</li>
				<li class="list-group-item">
					Average Response Time 
					<span class="badge">
						{{ number_format($avg_response_time->time, 4) }} sn
					</span>
				</li>
				<li class="list-group-item">
					Average Memory Usage 
					<span class="badge">
						{{ Velocity::sizeToStr($avg_memory_usage->memory) }} 
					</span>					
				</li>
			</ul>			
		</div>
	</div>
@stop