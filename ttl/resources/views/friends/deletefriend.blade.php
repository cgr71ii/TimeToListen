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
        {{ csrf_field() }} 
        <div>
            <p style="text-align: center;"> ¿Do you want to remove {{ $friend->name }} {{$friend->lastname}} from your friend list? </p>
        </div> 
        <div style="text-align: center">
            <input type="hidden" name="friend" value={{$friend->id}} />
            <input type="submit" name="confirm" value="Yes">
            <input type="submit" name="confirm" value="No"><br/>
        </div>
    </form>

@endsection