<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Time to Listen</title>
    <link rel="stylesheet" type="text/css" href="css/root.css">
    @include('general-css')
</head>
<body>
    <div id="img-div">
        <img src="line.png">
    </div>
    <div id="content">
        <div id="log-in">
            <div id="log-in-content">
                <h3 style="text-align: center;">Log In</h3>

                <form method="POST" action="{{ action('UserController@login') }}">
                    {{ csrf_field() }}
                    <div><p>Email</p></div>
                    @if (Cookie::get('TTLusername') !== null)
                    <input type="text" class="text-input" name="username" value="{{ Cookie::get('TTLusername') }}">
                    @else
                    <input type="text" class="text-input" name="username">
                    @endif
                    <p>Password</p>
                    @if (Cookie::get('TTLpassword') !== null)
                    <input type="password" class="text-input" name="password" value="{{ Cookie::get('TTLpassword') }}">
                    @else
                    <input type="password" class="text-input" name="password">
                    @endif
                    @if (session('loginfail') !== null)
                    <p style="color: red;">Log In failed!</p>
                    @endif
                    <p>Remember me: <input type="checkbox" name="remember"></p>
                    <a href="#">I forgot my password</a>
                    <br>
                    <div style="text-align: center; margin-top: 20px;">
                        <input type="submit" value="Log In">
                    </div>
                </form>
            </div>
        </div>
        <div id="sign-up">
            <div id="sign-up-content">
                <h3 style="text-align: center;">Sign Up</h3>

                <form method="POST" action="{{ action('UserController@signup') }}" name="signup">
                    {{ csrf_field() }}
                    <div id="name-and-lname">
                        <div id="name-input">
                            <p>Name</p>
                            <input type="text" class="text-input" name="name">
                        </div>
                        <div id="lname-input">
                            <p>Last Name</p>
                            <input type="text" class="text-input" name="lname">
                        </div>
                    </div>
                    <p>Email</p>
                    <input type="text" class="text-input" name="username">
                    <p>Password</p>
                    <input type="password" class="text-input" name="password">
                    <p>Birthday</p>
                    <input type="date" class="text-input" name="birthday">
                    @if (session('signupfail') !== null)
                    <p style="color: red;">Sign Up failed!</p>
                    @elseif (session('signupfailuserexists') !== null)
                    <p style="color: red;">Sign Up failed! User already exists.</p>
                    @elseif (session('signupfailemptyfield') !== null)
                    <p style="color: red;">Sign Up failed! Can't be empty fields.</p>
                    @endif
                    <div style="text-align: center; margin-top: 20px;">
                        <input type="submit" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>