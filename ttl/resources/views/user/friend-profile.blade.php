@extends('general')

@section('title', 'Friend Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div id="user-info-wrapper">
        <div id="user-info-img">
            <!-- The conditinal it will check if session('friend')->pic_profile_path exists -->
            @if (File::exists(session('friend')->pic_profile_path))
            <img src="{{ asset(session('friend')->pic_profile_path) }}" alt="User Image">
            @else
            <img src="{{ asset('default-user.png') }}" alt="User Image">
            @endif
        </div>
        <div id="user-info-content">
            <div id="user-info-content-wrapper">
            <p>{{ session('friend')->name }} {{ session('friend')->lastname }}</p>
            @if (session('friend')->song_status !== null)
            <p><img src="{{ asset('favicon.png') }}"> {{ session('friend')->song_status->name }} <img src="{{ asset('favicon.png') }}"></p>
            @if (session('user')->song_status !== null && File::exists(session('friend')->song_status->song_path))
            <audio controls id="myaudio"><source src="{{ asset(session('friend')->song_status->song_path) }}" type="audio/mp3">Audio not Available!</audio>

            <script>
                var audio = document.getElementById("myaudio");
                audio.volume = 0.5;
            </script>
            @else
            <p>It could not find the song!</p>
            @endif
            @else
            <p>There is no song status selected!</p>
            @endif
            </div>
        </div>
    </div>
    @if (session('friend_publications')[0] !== null)
    <hr>
    <div id="pagination-box-style" class="ajax-publication">
        @include('publication.publications', ['actions' => false])
    </div>
    @endif

    @include('pagination-ajax', ['class_name' => 'ajax-publication', 'object_title' => 'Friend Publications'])

@endsection