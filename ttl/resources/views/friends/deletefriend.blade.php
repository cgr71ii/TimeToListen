@extends('general')

@section('title', "Profile")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/general.css">

@endsection

@section('content')
    <!--All body code here.-->

    <div>
        <h3 style="text-align: center;">Delete Friend</h3>
    </div>
    <form method="post" action="{{ ('FriendsController@deleteF') }}">
    {{ csrf_field() }}

        <div>
            <p style="text-align: center;"> ¿Do you want to remove {{ $friend->name }} {{$friend->lastname}} from your friends list? </p>
        </div> 
        <div style="text-align: center">
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="confirm" value="No"><br/>
        </div>
    </form>

@endsection