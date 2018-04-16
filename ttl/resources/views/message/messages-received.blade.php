@extends('general')

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <div id="write-pub">
        <h2>Received Messages</h2>
        @foreach (session('messages') as $message)
            <div style="text-align: left;">
                <p>Message From: {{ $message->user_id}}</br>
                Date: {{ $message->date }}</br>
                Title: {{ $message->title }}</br>
                Body of Message:</p>
            </div>
            <div class="publication" style="background-color: white;">
                <p> {{$message->text}}</p>
            </div>
            <br/>
        @endforeach
    </div>
@endsection