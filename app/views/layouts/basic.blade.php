<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelidata Project</title>
    <!-- Latest compiled and minified CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
{{ HTML::style('css/frontend.min.css') }}
</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span class="fa fa-bar-chart-o"></span> Intelidata Stadistics</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="user-profile">
                        <figure>
                            <figcaption>
                                <strong>Diego Pinto</strong>
                                <ul>
                                    <li> <a href="{{ URL::to('logout') }}">Logout</a></li>
                                </ul>
                            </figcaption>
                            <img src="holder.js/40x40" class="img-circle img-responsive pull-left" alt="">
                        </figure>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-sm-3 col-md-2 sidebar">
                @yield('aside')
            </aside>
            <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('content')
            </section>
        </div>
    </div>
    <footer class="container-fluid"></footer>
    <!-- JQuery 1.11.1 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap 3.2 JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- HOLDER.JS -->
    {{ HTML::script('js/holder.js') }}
    <!-- Charts -->
    {{ HTML::script('js/amcharts/amcharts.js') }}
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/exporting/amexport_combined.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>
    <!-- Custom JS -->
    {{ HTML::script('js/frontend.min.js') }}
    <script type="text/javascript">
        @yield('script')
    </script>
</body>
</html>