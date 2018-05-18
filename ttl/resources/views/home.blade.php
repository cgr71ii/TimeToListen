<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="/favicon.png">
    <title>Time to Listen</title>
    <link rel="stylesheet" type="text/css" href="/css/root.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    @include('general-css')
</head>
<body>
    <div id="img-div">
        <img src="line.png">
    </div>
    <div id="content">
        <div id="information">
                <h1 style="text-align: center;">We Are Glad To Hear You!</h3>
                <h2 style="text-align: center;">Connect on Time to Listen</h4>
            <div style="margin-top:5%; font-size: 20px">
                <p style="text-size: 20px">Discover, stream, and share a constantly expanding mix of music from 
                    emerging and major artists around the world.</p>
            </div>
            <div style="margin-top: 5%;text-align:center">
                <p><a href="/loginsignup"> Sign up for free </a></p>
            </div>

        </div>
        <div id="log-in">
            <div id="log-in-content" style="margin-top:5%">

                <form method="POST" action="{{ action('UserController@show') }}">
                    {{ csrf_field() }}
                    <div><p>Email</p></div>
                    @if (Cookie::get('TTLusername') !== null)
                    <input type="email" class="text-input" name="username" value="{{ Cookie::get('TTLusername') }}" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                    @else
                    <input type="email" class="text-input" name="username" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                    @endif
                    <p>Password</p>
                    @if (Cookie::get('TTLpassword') !== null)
                    <input type="password" class="text-input" name="password" value="{{ Cookie::get('TTLpassword') }}">
                    @else
                    <input type="password" class="text-input" name="password">
                    @endif
                    
                    <p>Remember me: <input type="checkbox" style="width: 20px;" name="remember"></p>
                    <a href="#">I forgot my password</a>
                    <br>
                    <div style="text-align: center; margin-top: 20px;">
                        <input type="submit" value="Log In">
                    </div>
                </form>
                @if (session('loginfail') !== null)
                <hr>
                <div class="alert alert-danger">
                    <strong>Error!</strong> Log In failed!
                </div>
                @endif
            </div>
        </div>
        
    </div>

    <div id="general-footer-height"></div>
    <div id="general-footer">
        <div style=" position: relative;float: left; margin-left:35%">   
            <p>Design of Software System</p>
            <p>2017 - 2018</p>
            <p>Time to Listen</p>
        </div>
        <div style=" position: relative;float: right;margin-right: 35%;">
            <p style="margin-top: 20%"><a href="/contact"> Contact us </a></p>
            <p><a href="/information"> More information </a></p>
        </div>
    </div>
</body>
</html>