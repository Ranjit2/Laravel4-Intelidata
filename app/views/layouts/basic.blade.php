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
    <div class="progress active">
        <div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            <span class="sr-only">0% Complete</span>
        </div>
    </div>
    <header id="header">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{ HTML::link('login','Stats', array('class' => 'navbar-brand')); }}
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav"></ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div class="user-profile">
                                <figure>
                                    <img src="holder.js/50x50" class="img-responsive" alt="Responsive image">
                                    <figcaption>
                                        <strong>{{ HTML::link('#','Username'); }}</strong>
                                        <ul>
                                            <li>{{ HTML::link('#','Inbox', array("data-original-title" => "Message inbox")); }}</li>
                                            <li>{{ HTML::link('#','Settings', array("data-original-title" => "Account settings")); }}</li>
                                            <li>{{ HTML::link('logout','Logout', array("data-original-title" => "Logout")); }}</li>
                                        </ul>
                                    </figcaption>
                                </figure>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            @yield('bar')
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div>
    <footer class="container">
    </footer>
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