@extends('general')

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <!--All body code here.-->

    @if (session('error_not_friend') !== null)
    <div class="alert alert-danger" style="width: 80%; margin: 0 auto;">
        <strong>Error!</strong> {{ session('user_friend') }} is not your friend!
    </div>
    @elseif (session('error_non_existent_user') !== null)
    <div class="alert alert-danger" style="width: 80%; margin: 0 auto;">
        <strong>Error!</strong> The user {{ session('user_friend') }} does not exist!
    </div>
    @endif
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
            @if (session('user')->song_status !== null && File::exists(session('user')->song_status->song_path))
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
            <p>Click <a href="{{ action('UserController@showSettings') }}">here</a> to modify your profile!</p>
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
        <form method="POST" action="{{ action('PublicationController@create') }}">
            {{ csrf_field() }}
            <textarea name="publication"></textarea><br>
            <select name="publication_group" style="float: left;">
                <option value="own_publication">Own Publication</option>
                @foreach (session('user')->group_user as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
                @if (count(session('user')->group_user) != 0)
                <option value="all_groups">All Groups</option>
                @endif
            </select>
            <input type="submit" value="Publicate">
        </form>
    </div>
    @if (session('publications')[0] !== null)
    <hr>
    <div id="pagination-box-style" class="ajax-publication">
        @include('publication.publications', ['actions' => true, 'group_notify' => true])
    </div>
    @endif

    @include('pagination-ajax', ['class_name' => 'ajax-publication', 'object_title' => 'Publications'])

@endsection