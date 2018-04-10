<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="css/root.css">
    @include('general-css')
</head>
<body>
    <div id="img-div">
        <img id="main-img" src="line.png">
    </div>
    <div id="content">
        <div id="log-in">
            <div id="log-in-content">
                <h3 style="text-align: center;">Log In</h3>

                <form method="POST" action="">
                    <p>Email</p>
                    <input type="text" class="text-input" id="username">
                    <p>Password</p>
                    <input type="password" class="text-input" id="password">
                    <p>Remember me: <input type="checkbox" id="remember"></p>
                    <a href="">I forgot my password</a>
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

                <form method="POST" action="">
                    <div id="name-and-lname">
                        <div id="name-input">
                            <p>Name</p>
                            <input type="text" class="text-input" id="name">
                        </div>
                        <div id="lname-input">
                            <p>Last Name</p>
                            <input type="text" class="text-input" id="lname">
                        </div>
                    </div>
                    <p>Email</p>
                    <input type="text" class="text-input" id="username">
                    <p>Password</p>
                    <input type="password" class="text-input" id="password">
                    <p>Birthday</p>
                    <input type="date" class="text-input" id="birthday">
                    <div style="text-align: center; margin-top: 20px;">
                        <input type="submit" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>