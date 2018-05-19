@extends('general')

@section('title', "Friends")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">

@endsection

@section('content')
    <!--All body code here.-->

    <div>
        <h3 style="text-align: center;">Delete Friend</h3>
    </div>
    <form method="post" action="{{ action ('FriendsController@deleteF') }}">
    </form>

@endsection