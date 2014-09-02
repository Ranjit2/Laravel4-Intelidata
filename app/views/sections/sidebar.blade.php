<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="{{ URL::to('/') }}"><span class="icon fa fa-home fa-lg fa-fw"></span>Home</a>
			</h4>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="{{ URL::to('/timeline') }}"><span class="icon fa fa-clock-o fa-lg fa-fw"></span>Linea de Tiempo</a>
			</h4>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="icon fa fa-file-text-o fa-lg fa-fw"></span>Reportes</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body">
				<table class="table">
					@if (Session::get('ses_user_tipo') === 'cliente')
					<tr>
						<td>
							<a href="{{ URL::to('/charts/pie') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Donut/Pie Chart</a>
						</td>
					</tr>
					@endif
					<tr>
						<td>
							<a href="{{ URL::to('/charts/column') }}"><span class="icon pe-7s-graph3 fa-lg fa-fw"></span>Historico Facturado</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="{{ URL::to('/charts/stackbar') }}"><span class="icon pe-7s-graph3 fa-lg fa-fw"></span>Hisórico Acumulado</a>
						</td>
					</tr>
					@if (Session::get('ses_user_tipo') === 'empresa')
					<tr>
						<td>
							<a href="{{ URL::to('/charts/breakchart') }}"><span class="icon pe-7s-help2 fa-lg fa-fw"></span>Detalle por Mes</a>
						</td>
					</tr>
					@endif
					<tr>
						<td>
							<a href="{{ URL::to('/charts/evolution') }}"><span class="icon pe-7s-graph2 fa-lg fa-fw"></span>Evolución de mis gastos</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="{{ URL::to('/charts/comparative') }}"><span class="icon pe-7s-graph2 fa-lg fa-fw"></span>Gráfico comparativo</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="{{ URL::to('/charts/grafHistoricoCategoria') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Histórico por categorías</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="{{ URL::to('/charts/telefonosPorProducto') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Tel&eacute;fonos por productos</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="{{ URL::to('/user/message') }}"><span class="icon fa fa-envelope-o fa-lg fa-fw"></span><span class="badge pull-right">4</span>Centro de Mensajes</a>
			</h4>
		</div>
	</div>
</div>
