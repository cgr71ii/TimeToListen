@extends('general')

@section('title', "Profile")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/profile-songs.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div>
        <h3 style="text-align: center;"> Add Songs </h3>

        <form method="POST" action="{{ action('SongController@add_song') }}" class="container" name="add_song" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3 col-md-offset-3">
                    <p> Name: </p>
                    <input type="text" class="text-input" name="song_name">
                    <p><br> Song (mp3 format): </p>
                    <div>
                        <input type="file" name="song_file" accept=".mp3">
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <p><br> Genre: </p>
                    <select name="genres" size="4" multiple>
                        <option value ="rock"> Rock </option>
                        <option value ="synthwave"> Synthwave </option>
                        <option value ="outrun"> Outrun </option>
                        <option value ="pop"> Pop </option>
                        <option value ="rap"> Rap </option>
                        <option value ="hip-hop"> Hip-Hop </option>
                        <option value ="metalcore"> Metalcore </option>
                        <option value ="electroswing"> Electroswing </option>
                    </select>
                    <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
                </div>
            </div>
            
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
                    <li> The file format must be mp3. </li>
                </ul>
            </div>
            @endif

            <div align="center">
                <input type="submit" value="Upload Song">
            </div>
        </form>
    </div>

    <div>
        <h3 style="text-align: center;"> My Songs </h3>

    </div>
@endsection