@extends('general')

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <div id="write-pub">
        <h2>My Messages</h2>
        <a style="float: right;" href="{{ URL::to('/messages/send') }}" class="general-main-menu-option">
            <p>Send Message</p>
        </a>
        <a style="float: left;"href="{{ URL::to('/messages/received') }}" class="general-main-menu-option">
            <p>Received Messages</p>
        </a>
    </div>

@endsection