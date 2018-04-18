@extends('general')

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
<div id="write-pub">
    <h2>Send Message</h2>
    <p style="float: left;"> Select your friends:</p>
    <form method="POST" action="{{ action('MessageController@create') }}">
        {{ csrf_field() }}
        <select name="receptors[]" multiple class="publication-text-wrapper">
            <option value="all">All Friends</option>
            @foreach(session('friends')  as $friend)
                <option value={{$friend->id}}>{{$friend->name}}</option>
            @endforeach
        </select>
        <span style="float:left;">Title</span> </br>
        <textarea style="height: auto;" rows="1" cols="10"name="title"></textarea></br>
        <span style="float:left;">Body of Message</span> </br>     
        <!--<input class="publication-text-wrapper" name="body" type="text">-->
        <textarea style="height: auto;" rows="10" cols="50"name="body" rows="20"></textarea><br>
        <div id="button_send">
            <input type="submit" value="Send">
        </div>
    </form>
</div>
@endsection
