@extends('general')

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div id="user-info-wrapper">
        <div id="user-info-img">
            <!-- The conditinal it will check if session('user')->pic_profile_path exists -->
            @if (File::exists(session('user')->pic_profile_path))
            <img src="{{ session('user')->pic_profile_path }}" alt="User Image">
            @else
            <img src="default-user.png" alt="User Image">
            @endif
        </div>
        <div id="user-info-content">
            <div id="user-info-content-wrapper">
            <p>{{ session('user')->name }} {{ session('user')->lastname }}</p>
            @if (session('user')->song_status !== null)
            <p><img src="favicon.png"> {{ session('user')->song_status->name }} <img src="favicon.png"></p>
            @if (File::exists(session('user')->song_status->song_path))
            <audio controls id="myaudio"><source src="{{ session('user')->song_status->song_path }}" type="audio/mp3">Audio not Available!</audio>

            <script>
                var audio = document.getElementById("myaudio");
                audio.volume = 0.5;
            </script>
            @else
            <p>It could not find the song!</p>
            @endif
            @else
            <p>There is no song status selected!</p>
            <p>Click <a href="{{ URL::to('/settings') }}">here</a> to modify your profile!</p>
            @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="write-pub">
        <h2>New Publication</h2>
        @if (session('create_publication_fail') !== null)
        <div class="alert alert-danger">
            <strong>Error!</strong> Publication can not have empty fields!
        </div>
        @endif
        <form method="POST" action="{{ action('UserController@publicate') }}">
            {{ csrf_field() }}
            <textarea name="publication"></textarea><br>
            <input type="submit" value="Publicate">
        </form>
    </div>
    @if (session('publications')[0] !== null)
    <hr>
    <div id="publications" class="ajax-publication">
        @include('user.publications')
    </div>
    @endif

    @include('user.publications-ajax')

@endsection