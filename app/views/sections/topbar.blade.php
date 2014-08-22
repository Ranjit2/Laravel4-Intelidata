<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3 logotipo">
		<img src="holder.js/280x100" alt="" class="img-responsive">
		<!-- <strong>LOGO EMPRESA</strong> -->
		<!-- <p class="muted">slogan</p> -->
	</div>
	<div class="col-xs-12 col-sm-12 col-md-5 pull-right user-profile">
		<div class="col-xs-2 col-sm-2 col-md-2"> <!-- required for floating -->
			<!-- Nav tabs -->
			<ul class="nav nav-tabs tabs-left" id="nav-profile">
				<li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-arrow-right"></i></a></li>
				<li><a href="#profile" data-toggle="tab"><i class="fa fa-arrow-right"></i></a></li>
			</ul>
		</div>
		<div class="col-xs-7 col-sm-7 col-md-7 user-no-pad">
			<div class="main-info">
				<div class="tab-content">
					<div class="tab-pane fade in active" id="home">
						<h3>Bienvenido, <b>Michael Knight</b></h3>
						<small>Aquí podrás revisar tus gastos, extraer graficos y realizar los pagos de tus servicios contratados</small>
					</div>
					<div class="tab-pane fade" id="profile">
						<div class="optional-info">
							<h3>Informaci&oacute;n Personal</h3>
							<h5><b>RUN:</b> 11.111.111-1</h5>
							<address>
								<strong>Contacto</strong><br>
								<abbr title="Teléfono"><span class="glyphicon glyphicon-earphone"></span>:</abbr> (123) 2777-7777&nbsp;<abbr title="Email"><span class="glyphicon glyphicon-envelope"></span>:</abbr> <a href="mailto:michaelnightrider@gmail.com">michaelnightrider@gmail.com</a><br>
								<strong>Direccción</strong><br>
								795 Folsom Ave, Suite 600, Santiago, Chile.<br>
							</address>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 pull-right image no-pad">
			<img src="http://2.bp.blogspot.com/-eHwFBSrAMxA/TpRD6MDv5RI/AAAAAAAAA3g/XdZwVB9QXSE/s1600/michael%2Bknight.jpg" class="img-responsive">
		</div>
	</div>
</div>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="sr-only">
				<a class="navbar-brand" href="http://www.wsnippets.com">iData</a>
			</div>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown menu-large">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon fa fa-comments-o fa-lg fa-fw"></span> Contactanos <b class="caret"></b></a>
					<ul class="dropdown-menu megamenu row">
						<li class="col-sm-3">
							<!-- <ul>
								<li class="dropdown-header">TEL&Eacute;FONOS DE EMERGENCIA</li>
								<li><a href="#">600 800 9000</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">DESDE CELULARES</li>
								<li><a href="#">02 - 2310 0200</a></li>
							</ul> -->
							{{HTML::genera_telefonos_empresa()}}
						</li>
						<li class="col-sm-3">
							<ul>
								<li class="dropdown-header">CENTRO DE AYUDA ONLINE</li>
								<!-- <li><a href="#">BANDA ANCHA</a></li>
								<li><a href="#">TELEFON&Iacute;A CELUALR</a></li>
								<li><a href="#">TELEFON&Iacute;A FIJA</a></li>
								<li><a href="#">TELEVISI&Oacute;N POR CABLE</a></li>
								<li><a href="#">TELEVISI&Oacute;N SATELITAL</a></li> -->
								{{HTML::genera_centro_ayuda()}}
							</ul>
						</li>
						<li class="col-sm-3" style="padding:0 10px">
							<ul>
								<li class="dropdown-header">SUCURSALES</li>
									<!-- <li><a href="#">sucursal 1  Horario de Atencion1</a></li>
									<li><a href="#">sucursal 2  Horario de Atencion2</a></li>
									<li><a href="#">sucursal 3  Horario de Atencion3</a></li> -->
								{{HTML::genera_sucursales_empresa()}}
							</ul>
						</li>
						<li class="col-sm-3">
							<ul>
								<li class="dropdown-header">SUCURSAL VIRTUAL</li>
								<li class="divider"></li>
								<li class="dropdown-header">SERVICIOS</li>
								<!-- <li><a href="#">servicio 1</a></li>
								<li><a href="#">servicio 1</a></li>
								<li><a href="#">servicio 1</a></li> -->
								{{HTML::genera_servicios_empresa()}}
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
				<li><a href="https://svirtual.vtr.net/svweb/pagoExpress.html" class="navbar-link"><i class="fa fa-credit-card fa-lg fa-fw"></i> Pago WEB</a>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user fa-lg fa-fw"></span> Usuario<b class="caret"></b></a>
						<ul class="dropdown-menu megamenu row">
							<li><a href="{{ URL::to('/user/profile') }}"><span class="icon fa fa-cog fa-fw"></span>Perfil</a></li>
							<li><a href="{{ URL::to('/user/question') }}"><span class="icon fa fa-question fa-fw"></span>Contacto</a></li>
							<li><a href="{{ URL::to('/logout') }}"><span class="icon fa fa-sign-out fa-fw"></span>Salir</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
