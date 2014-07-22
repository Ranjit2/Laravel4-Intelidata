@extends('velocity::layout')

@section('title')
{{ $title }} 
@stop

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="1%">#</th>
				<th class="col-md-1">Method</th>
				<th>Url</th>
				<th>Controller</th>
				<th class="text-right">Memory Usage</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($lives !== false) : ?>
				<?php foreach ($lives as $key => $value) : ?>
					<tr>
						<td>
							<strong>
								{{ ( ($lives->getCurrentPage() - 1) * 15 + $key + 1) }})
							</strong>
						</td>
						<td>
							@if ($value->method == 'GET')
								<span class="label label-success">
									{{ $value->method }}
								</span>
							@else 
								<span class="label label-danger">
									{{ $value->method }}
								</span>
							@endif 
						</td>
						<td>{{ $value->url }}</td>
						<td>{{ $value->controller }}</td>
						<td class="text-right">
							{{ Velocity::sizeToStr($value->memory_usage) }}
						</td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" class="text-right">
					{{ $lives->getTotal() }} records found.
				</td>
			</tr>
		</tfoot>
	</table>
	<?php echo $lives->links(); ?>
@stop