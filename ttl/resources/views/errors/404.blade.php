<!--
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/css/errors.css">
    </head>
    <body>
        <div id="error-container">
            <div id="error404container">
                <h1>Error 404</h1><br><br><br>
                <p>It looks like if that song was not in our Database...</p><br><br>
                <p>Try Again!</p>
                <p><img src="{{ asset('favicon.png') }}"><a href="{{ action('UserController@show') }}">https://www.timelisten.com/</a><img src="{{ asset('favicon.png') }}"></p>
            </div>
        </div>
    </body>
</html>
-->

@extends('general', ['menu' => false])

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/errors.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
<div id="error-container">
    <div id="error404container">
        <h1>Error 404</h1><br><br><br>
        <p>It looks like if that song was not in our Database...</p><br><br>
        <p>Try Again!</p>
        <p><img src="{{ asset('favicon.png') }}"><a href="{{ action('UserController@show') }}">https://www.timelisten.com/</a><img src="{{ asset('favicon.png') }}"></p>
    </div>
</div>
@endsection