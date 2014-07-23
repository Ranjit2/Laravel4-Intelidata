<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelidata Project</title>
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/frontend.min.css">
    <!-- <link rel="stylesheet" href="js/amcharts_3.10.0.free/images/style.css" type="text/css"> -->
</head>
<body>
    <div class="progress active">
        <div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            <span class="sr-only">0% Complete</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @yield('login')
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- JQuery 1.11.1 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap 3.2 JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Charts -->
    <script src="js/amcharts_3.10.0.free/amcharts/amcharts.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/dark.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/black.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/exporting/amexport_combined.js"></script>
    <!-- Custom JS -->
    <script src="js/frontend.js"></script>
    <script type="text/javascript">
        @yield('script')
    </script>
</body>
</html>