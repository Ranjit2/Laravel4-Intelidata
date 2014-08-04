<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDATA - @yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and
    media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{ HTML::style('css/frontend.min.css') }}
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    {{ HTML::style('css/pe-icon-7-stroke.css') }}
    {{ HTML::style('css/helper.css') }}
    @yield('style')
</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="fa
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
                            @else
                            User 111111-1
                            @endif
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"> <span class="icon pe-7s-info"></span> Profile</a></li>
                            <li><a href="{{ URL::to('/logout') }}"><span class="icon pe-7s-close-circle"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-sm-3 col-md-2 sidebar">
                @section('aside')
                <div class="list-group">
                    {{ HTML::link('/', 'HOME', array('class' => 'list-group-item')) }}
                    @include('layouts.menus.menu_cliente')
                </div>
                @show
                <footer class="main-footer">
                    <a class="back-top" href="#">
                        <p>{{ Carbon::now()->year }} &copy; Intelidata.</p>
                    </a>
                </footer>
            </aside>
            <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <header>
                    @section('header')
                    <div class="calendar pull-right">
                        <i class="icon pe-7s-date"></i>
                        <span>{{ Carbon::now()->format('l jS \\of F Y h:i:s A') }}</span>
                        <i class="pe-7s-angle-down-circle"></i>
                    </div>
                    <h2 class="main-header__title">
                        <i class="icon pe-7s-graph"></i>
                        Statistics <small>Charts &amp; graphs</small>
                    </h2>
                    @show
                    <ol class="breadcrumb">
                        @section('breadcrumb')
                        <li>{{ HTML::link('/', 'HOME') }}</li>
                        @show
                    </ol>
                </header>
                @yield('content')
            </section>
        </div>
    </div>
    <!-- JQuery 1.11.1 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap 3.2 JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- HOLDER.JS -->
    {{ HTML::script('js/holder.js') }}
    <!-- Charts -->
    {{ HTML::script('js/amcharts/amcharts.js') }}
    <script type="text/javascript"
    src="http://www.amcharts.com/lib/3/pie.js"></script>
    <script type="text/javascript"
    src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript"
    src="http://www.amcharts.com/lib/3/exporting/amexport_combined.js"></script>
    {{ HTML::script('js/amcharts/exporting/amexport.js') }}
    <script type="text/javascript"
    src="http://www.amcharts.com/lib/3/themes/none.js"></script>
    <!-- Custom JS -->
    {{ HTML::script('js/frontend.min.js') }}
    @yield('script')
</body>
</html>

