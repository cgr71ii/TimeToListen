@extends('general')

@section('title', 'Messages')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')

    <div class="write-pub">
        <h2>Send Message</h2>
        <hr>
        <p style="float: left;"> Select your friends:</p>
        <form method="POST" action="{{ action('MessageController@create') }}">
            {{ csrf_field() }}
            <select name="receptors[]" multiple class="pagination-content-wrapper">
                <!--<option value="all">All Friends</option>-->
                @foreach($friends as $friend)
                    <option value='{{$friend->id}}'>{{$friend->name}} {{$friend->lastname}}</option>
                @endforeach
            </select>
            <span style="float:left;">Title</span>
            <br>
            <textarea style="height: auto;" rows="1" cols="10" name="title"></textarea>
            <br>
            <span style="float:left;">Body of Message</span>
            <br>
            <!--<input class="pagination-content-wrapper" name="body" type="text">-->
            <textarea style="height: auto;" rows="10" cols="50" name="body"></textarea>
            <br>
            <div id="button_send">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>

    @if (count($messages_sent_count) != 0)
    <hr>

    <div class="write-pub" style="margin-bottom: 20px;">
        <h2>Sent Messages</h2>

        <a href="{{ action('MessageController@listSentMessages') }}">Read my sent messages</a>
    </div>
    @endif

    @if (count($messages_recv_count) != 0)
    <hr>
    <div class="write-pub" style="margin-bottom: 20px;">
        <h2>Received Messages</h2>

        <a href="{{ action('MessageController@listReceivedMessages') }}">Read my received messages</a>
    </div>
    @endif

@endsection