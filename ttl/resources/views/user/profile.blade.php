@extends('general')

@section('title', "Profile")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/profile.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div id="user-info-wrapper">
        <div id="user-info-img">
            <img src="default-user.png" alt="User Image">
        </div>
        <div id="user-info-content">
            <div id="user-info-content-wrapper">
            <p>Name Lastname</p>
            <p><img src="music.png"> Song Status <img src="music.png"></p>
            <audio controls><source src="a7x - buried alive.mp3" type="audio/mp3">Audio not Available!</audio>
            </div>
        </div>
    </div>
    <div id="write-pub">
        <p>New Publication</p>
        <form method="POST" action="">
            {{ csrf_field() }}
            <textarea name="publication"></textarea><br>
            <input type="submit" value="Publicate">
        </form>
    </div>
    <div id="publications">
        <p>Pubs</p>
    </div>
@endsection