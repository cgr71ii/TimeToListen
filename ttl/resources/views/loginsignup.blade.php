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
    <div id="content" style="margin-top: 5%">
        <div id="sign-up">
            <div id="sign-up-content">
                <h3 style="text-align: center;">Sign Up</h3>
                <div style="margin-top: 15%">
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
                        <input type="email" class="text-input" name="username" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                        <p>Password</p>
                        <input type="password" class="text-input" name="password">
                        <p>Birthday</p>
                        <input type="date" class="text-input" name="birthday">
                        <div style="text-align: center; margin-top: 20px;">
                            <input type="submit" value="Sign Up">
                            <input type="submit" name="submitted" value="Cancel" style="margin-top:1%" onclick="/">
                        </div>

                        @if (session('signupfail') !== null)
                        <hr>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Sign Up failed!
                        </div>
                        @elseif (session('signupfailuserexists') !== null)
                        <hr>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Sign Up failed! User already exists.
                        </div>
                        @elseif (session('signupfailemptyfield') !== null)
                        <hr>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Sign Up failed! Can't be empty fields.
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>