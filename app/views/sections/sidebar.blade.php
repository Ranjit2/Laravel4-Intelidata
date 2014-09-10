<ul class="nav">
	<li class="{{ HTML::activeLink('home') }}">
		<a href="{{{ URL::to('/home') }}}"  class="{{{ HTML::activeState('home') }}}"><span class="icon fa fa-home fa-lg fa-fw"></span>Home</a>
	</li>
	<li  class="{{ HTML::activeLink('timeline') }}">
		<a href="{{ URL::to('timeline') }}"><span class="icon fa fa-clock-o fa-lg fa-fw"></span>Linea de Tiempo</a>
	</li>
	<li class="{{ HTML::activeState(array('charts/pie','charts/column','charts/stackbar','charts/breakchart','charts/evolution','charts/comparative','charts/grafHistoricoCategoria','charts/grafHistoricoMes','charts/telefonosPorProducto')) }}">
		<a class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			<span class="icon fa fa-file-text-o fa-lg fa-fw"></span>Reportes</a>
		</a>
		<ul class="list-unstyled children collapse" id="collapseOne">
			@if (Session::get('ses_user_tipo') == 'cliente')
			<li class="{{ HTML::activeLink('charts/pie') }}">
				<a href="{{ URL::to('/charts/pie') }}"><span class="icon pe-7s-graph fa-lg fa-fw "></span>Donut/Pie Charts</a>
			</li>
			<hr>
			@endif
			<li class="{{ HTML::activeLink('charts/column') }}">
				<a href="{{ URL::to('/charts/column') }}"><span class="icon pe-7s-graph3 fa-lg fa-fw"></span>Historico Facturado</a>
			</li>
			<hr>
			<li class="{{ HTML::activeLink('charts/stackbar') }}">
				<a href="{{ URL::to('/charts/stackbar') }}"><span class="icon pe-7s-graph3 fa-lg fa-fw"></span>Hist&oacute;rico Acumulado</a>
			</li>
			<hr>
			@if (Session::get('ses_user_tipo') == 'empresa')
			<li class="{{ HTML::activeLink('charts/breakchart') }}">
				<a href="{{ URL::to('/charts/breakchart') }}"><span class="icon pe-7s-help2 fa-lg fa-fw"></span>Detalle por mes</a>
			</li>
			<hr>
			@endif
			<li class="{{ HTML::activeLink('charts/evolution') }}">
				<a href="{{ URL::to('/charts/evolution') }}"><span class="icon pe-7s-graph2 fa-lg fa-fw"></span>Evolución gasto total mensual</a>
			</li>
			<hr>
			<li class="{{ HTML::activeLink('charts/comparative') }}">
				<a href="{{ URL::to('/charts/comparative') }}"><span class="icon pe-7s-graph2 fa-lg fa-fw"></span>Gráfico comparativo</a>
			</li>
			<hr>
			<li class="{{ HTML::activeLink('charts/grafHistoricoCategoria') }}">
				<a href="{{ URL::to('/charts/grafHistoricoCategoria') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Histórico por categorías</a>
			</li>
			<hr>
			<li class="{{ HTML::activeLink('charts/grafHistoricoMes') }}">
				<a href="{{ URL::to('/charts/grafHistoricoMes') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Histórico por mes</a>
			</li>
			<hr>
			<li class="{{ HTML::activeLink('charts/telefonosPorProducto') }}">
				<a href="{{ URL::to('/charts/telefonosPorProducto') }}"><span class="icon pe-7s-graph fa-lg fa-fw"></span>Tel&eacute;fonos por productos</a>
			</li>
		</ul>
	</li>
	<li class="{{ HTML::activeLink('user/message') }}">
		<a href="{{ URL::to('/user/message') }}"><span class="icon fa fa-envelope-o fa-lg fa-fw"></span><span class="badge pull-right">4</span>Centro de Mensajes</a>
	</li>
	<!-- <li class="item-8 deeper parent">
		<a class="" href="#">
			<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-8" class="sign"><i class="icon-plus icon-white"></i></span>
			<span class="lbl">Menu Group ii</span>
		</a>
		<ul class="children nav-child unstyled small collapse" id="sub-item-8">
			<li class="item-9 deeper parent ">
				<a class="" href="#">
					<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-9" class="sign"><i class="icon-plus icon-white"></i></span>
					<span class="lbl">Menu 1</span>
				</a>
				<ul class="children nav-child unstyled small collapse" id="sub-item-9">
					<li class="item-10 ">
						<a class="" href="#">
							<span class="sign"><i class="icon-play"></i></span>
							<span class="lbl">Menu 1.1</span>
						</a>
					</li>
					<li class="item-11 ">
						<a class="" href="#">
							<span class="sign"><i class="icon-play"></i></span>
							<span class="lbl">Menu 1.2</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="item-12 deeper parent">
				<a class="" href="#">
					<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-12" class="sign"><i class="icon-plus icon-white"></i></span>
					<span class="lbl">Menu 2</span>
				</a>
				<ul class="children nav-child unstyled small collapse" id="sub-item-12">
					<li class="item-13">
						<a class="" href="#">
							<span class="sign"><i class="icon-play"></i></span>
							<span class="lbl">Menu 2.1</span>
						</a>
					</li>
					<li class="item-14">
						<a class="" href="#">
							<span class="sign"><i class="icon-play"></i></span>
							<span class="lbl">Menu 2.2</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li> -->
</ul>
