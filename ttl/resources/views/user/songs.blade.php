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

        <form method="POST" action="" class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-3">
                    <p> Name: </p>
                    <input type="text" class="text-input" id="song-name">
                    <p><br> Genre: </p>
                    <select name="genres" size="4">
                        <option value ="rock"> Rock </option>
                        <option value ="synthwave"> Synthwave </option>
                        <option value ="outrun"> Outrun </option>
                        <option value ="pop"> Pop </option>
                        <option value ="rap"> Rap </option>
                        <option value ="hip-hop"> Hip-Hop </option>
                        <option value ="metalcore"> Metalcore </option>
                        <option value ="electroswing"> Electroswing </option>
                    </select>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <p> Song: </p>
                    <div>
                        <input type="file" value="Browse...">
                    </div>
                </div>
            </div>
            <div align="center">
                <p><br></p>
                <input type="submit" value="Upload Song">
            </div>
        </form>
    </div>

    <div>
        <h3 style="text-align: center;"> My Songs </h3>

    </div>
@endsection