<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Boothead Example - @yield('title')</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/ahir/velocity">Ahir/Velocity</a>
            </div>
            <div class="navbar-collapse collapse navbar-inverse-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/ahir/velocity">Live</a></li>
                    <li><a href="/ahir/velocity/slowspeed">Slowspeed</a></li>
                    <li><a href="/ahir/velocity/memory_usage">Memory Usage</a></li>
                    <li><a href="/ahir/velocity/stats">Stats</a></li>
                </ul>
            </div>
        </div>
        <br />
        <h1>
            @yield('title')
        </h1>
        <br />
    </div>
    <div class="container">
        @yield('content')
    </div>
  </body>
</html>