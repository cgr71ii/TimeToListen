<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="/favicon.png">
    @include('general-css')
    @yield('css')
    <title>
    @section('title')
        Welcome
    @show
    - Time to Listen
    </title>
</head>
<body>
    @if (!isset($menu) || $menu == true)
    <div id="general-main-menu-wrapper">
        @include('horizontally-main-menu')
    </div>
    @endif
    <div id="general-content-wrapper">
        @yield('content')
    </div>
    <div id="general-footer-height"></div>
    <div id="general-footer">
        <p>Design of Software System</p>
        <p>2017 - 2018</p>
        <p>Time to Listen</p>
    </div>
</body>
</html>