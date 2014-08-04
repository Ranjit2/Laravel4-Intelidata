<div class="list-group">
	<a href="{{ URL::to('/') }}" class="list-group-item"><span class="icon pe-7s-home"></span> HOME</a>
	<a href="{{ URL::to('/') }}" class="list-group-item"><span class="icon pe-7s-home"></span> Donut/Pie Chart</a>
	<a href="{{ URL::to('/') }}" class="list-group-item"><span class="icon pe-7s-home"></span> Columnbar Chart</a>
	<a href="{{ URL::to('/') }}" class="list-group-item"><span class="icon pe-7s-home"></span> Stackbar Chart</a>
	<a href="{{ URL::to('/') }}" class="list-group-item"><span class="icon pe-7s-home"></span> Break Chart</a>
	{{ HTML::link('/charts/pie', 'Donut/Pie Chart', array('class' => 'list-group-item')) }}
	{{ HTML::link('/charts/column', 'Columnbar Chart', array('class' => 'list-group-item')) }}
	{{ HTML::link('/charts/stackbar', 'Stackbar Chart', array('class' => 'list-group-item')) }}
	{{ HTML::link('/charts/breakchart', 'Break Chart', array('class' => 'list-group-item')) }}
</div>

<ul class="main-nav">
	<li>
		<a href="index-2.html" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-home"></i></span>
			Dashboard <span class="badge main-nav__badge badge--red">8</span>
		</a>
	</li>
	<li>
		<a href="ui.html" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-edit"></i></span>
			UI Elements
		</a>
	</li>
	<li class="main-nav--collapsible">
		<a href="#" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-photo-gallery"></i></span>
			Sample pages
		</a>
		<ul class="main-nav__submenu">
			<li><a href="404.html"><i class="pe-7s-help1"></i><span>Error 404</span></a></li>
			<li><a href="login.html"><i class="pe-7s-note"></i><span>Login</span></a></li>
		</ul>
	</li>
	<li>
		<a href="grid.html" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-crop"></i></span>
			Grid Layout
		</a>
	</li>
	<li>
		<a href="tables.html" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-menu"></i></span>
			Tables &amp; forms
		</a>
	</li>
	<li class="main-nav--active">
		<a href="#" class="main-nav__link">
			<span class="main-nav__icon"><i class="icon pe-7s-graph"></i></span>
			Statistics <span class="badge main-nav__badge">16</span>
		</a>
	</li>
</ul>