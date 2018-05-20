@extends('general')

@section('title', 'Admin Links')

@section('content')
    <!--All body code here.-->

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">You have the power!</span>
                            <span class="section-heading-lower">Admin Zone</span>
                        </h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('UserController@listUsers') }}">List Users</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('SongController@listSongs') }}">List Songs</a>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('GenreController@listGenres') }}">List Genres</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('GroupController@listGroups') }}">List Groups</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('MessageController@listMessages') }}">List Messages</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('PublicationController@listPublications') }}">List Publications</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <a href="{{ action('UserController@listLog') }}">List Log Entries</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection