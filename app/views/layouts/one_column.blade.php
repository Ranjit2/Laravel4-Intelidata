<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDATA | @yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and
    media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- CSS -->
    {{ HTML::style('css/frontend.min.css') }}
    {{ HTML::style('css/timeline.css') }}
    <!-- ICONS -->
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/mono-social-icons.css') }}
    {{ HTML::style('css/pe-icon-7-stroke.css') }}
    {{ HTML::style('css/helper.css') }}
    {{ HTML::style('css/bootstrap.vertical-tabs.css') }}
    @yield('style')
</head>
<body>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
    <footer class="container-fluid">
        <div class="row">
            @include('sections.footer')
        </div>
    </footer>
    <!-- JQUERY 1.11.1 -->
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    <!-- BOOTSTRAP 3.2 JS -->
    {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
    <!-- HOLDER.JS -->
    {{ HTML::script('js/holder.js') }}
    <!-- CUSTOM JAVASCRIPT -->
    {{ HTML::script('js/frontend.min.js') }}
    @yield('script')
</body>
</html>

