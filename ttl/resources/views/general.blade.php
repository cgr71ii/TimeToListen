<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('general-css')
    @yield('css')
    <title>
    @section('title')
        Time to Listen
    @show
    </title>
</head>
<body>
    <div id="general-main-menu-wrapper">
        @include('horizontally-main-menu')
    </div>
    <div id="general-content-wrapper">
        <h3 style="text-align: center;">Temporal border and message (this)</h3>
        <hr>
        @yield('content')
    </div>
</body>
</html>