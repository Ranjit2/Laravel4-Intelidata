<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle"
		data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="{{ URL::to('/') }}"><span class="fa
		fa-bar-chart-o"></span> <strong>Entel Empresa</strong></h3> Stadistics</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav  col-md-offset-3 navbar-right profile">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle profile__name" data-toggle="dropdown">
					<figure class="pull-left profile__img">
						<img src="holder.js/40x40" class="img-circle" alt="">
					</figure>
					@if (Session::has('ses_user_rut'))
					User <strong>{{ Session::get('ses_user_rut') }}</strong>
					@endif
					<span class="glyphicon glyphicon-chevron-down"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('/profile') }}"> <span class="icon pe-7s-info"></span> Profile</a></li>
					<li><a href="{{ URL::to('/logout') }}"><span class="icon pe-7s-close-circle"></span> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>