@extends('general', ['menu' => false])

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/errors.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
<div id="error-container">
    <div id="container">
        <h1>Error 403</h1><br><br><br>
        <p>You have tried to do something you should not have done.</p><br><br>
        <p>This action have been logged.</p>
        <p><img src="{{ asset('favicon.png') }}"><a href="{{ action('UserController@show') }}">https://www.timelisten.com/</a><img src="{{ asset('favicon.png') }}"></p>
    </div>
</div>
@endsection