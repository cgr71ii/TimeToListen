@extends('general')

@section('title', "Songs")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile-songs.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div>
        <h2 style="text-align: center;"> Add Songs </h2>
        <hr>
        <!--form method="POST" action="{{ action('SongController@add_song') }}" class="container" name="add_song" enctype="multipart/form-data"-->
        {!! Form::open(array('route' => 'song.add_song','files'=>true)) !!}
        {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3 col-md-offset-3">
                    <p> Name: </p>
                    <input type="text" class="text-input" name="song_name">
                    <p><br> Song (wav format): </p>
                    <div>
                        {!! Form::file('file') !!}
                        <!--input type="file" name="song_file" accept=".mp3"-->
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <p><br> Genre: </p>
                    <select name="chosen_genres[]" size="6" multiple>
                        @foreach (session('genres') as $genre)
                        <option value ="{{ $genre->id }}"> {{ $genre->name }} </option>
                        @endforeach
                    </select>
                    <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
                </div>
            </div>
            
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <h5> There were errors with the song upload petition: </h5>
                    <ul>
                        <li> {{$error}} </li>
                    </ul>
                </div>
                @endforeach
            @endif
            @if (session('emptyfields') !== null)
            <div class="alert alert-danger">
                <h5> There were errors with the song upload petition: </h5>
                <ul>
                    <li> There are empty fields that need to be completed. </li>
                </ul>
            </div>
            @endif
            @if (session('errorfile') !== null)
            <div class="alert alert-danger">
                <h5> There were errors with the song upload petition: </h5>
                <ul>
                    <li> The file format must be wav. </li>
                </ul>
            </div>
            @endif
            @if (session('success') !== null)
            <div class="alert alert-success">
                <h5> The song has been successfuly uploaded! </h5>
            </div>
            @endif

            <div align="center">
                <input type="submit" value="Upload Song">
            </div>

        {!! Form::close() !!}
        <!--/form-->
    </div>

    @if (session('songs')[0] !== null)
    <hr>
    <div id="pagination-box-style" class="ajax-publication">
        @include('song.songs-pag', ['songs' => session('songs')])
    </div>
    @endif

    @include('pagination-ajax', ['class_name' => 'ajax-publication', 'object_title' => 'Publications'])

@endsection