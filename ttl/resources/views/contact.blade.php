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
    <link rel="stylesheet" type="text/css" href="/css/contact.css">
    @include('general-css')
</head>
<body>
    <div id="img-div">
        <img src="line.png">
    </div>
    <div class="container">
        <form action="enviar.php">

            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name...">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name...">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email...">     

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something..." style="height:200px"></textarea>

            <input type="submit" value="Submit">

        </form>
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