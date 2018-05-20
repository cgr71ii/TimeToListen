<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">Keeping you in touch, through music.</span>
      <span class="site-heading-lower">Time To Listen</span>
    </h1>

    @include('horizontally-main-menu')
        
    @yield('content')
    
    <footer class="footer text-center py-5">
        <div class="container">
            <h5>Copyright &copy; Time To Listen 2018</h5>
        </div>
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>