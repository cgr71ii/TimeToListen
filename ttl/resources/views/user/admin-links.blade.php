@extends('general')

@section('title', 'Admin Links')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div style="width: 70%; margin: 0 auto;">
        <ul>
            <li><a href="{{ action('UserController@listUsers') }}">List Users</a></li>
            <li><a href="{{ action('SongController@listSongs') }}">List Songs</a></li>
            <li><a href="{{ action('GenreController@listGenres') }}">List Genres</a></li>
            <li><a href="{{ action('GroupController@listGroups') }}">List Groups</a></li>
            <li><a href="{{ action('MessageController@listMessages') }}">List Messages</a></li>
            <li><a href="{{ action('PublicationController@listPublications') }}">List Publications</a></li>
        </ul>
    </div>

@endsection