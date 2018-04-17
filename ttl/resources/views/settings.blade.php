@extends('general')

@section('title', 'Settings')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/profile.css">
    <link rel="stylesheet" type="text/css" href="/css/settings.css">
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
            <p>Set your song status here!</p>
            @endif
            </div>
            <a href="{{ URL::to('/user/logout') }}">Sign Out</a>
        </div>
    </div>

    <hr>

    @if (session('success') !== null)
    <div class="alert alert-success">
        <strong>Success!</strong> {{ session('success') }}
    </div>

    <hr>
    @endif

    <div id="settings-wrapper">
        {!! Form::open(array('route' => 'user.update.image','files'=>true)) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <p>Change Profile Image</p>
                </div>
                <div class="col-md-4">
                    {!! Form::file('image') !!}
                </div>
                <div class="col-md-4">
                    <!--<button type="submit" class="btn btn-success">Upload</button>-->
                    <input type="submit" value="Upload Image">
                </div>
            </div>
        {!! Form::close() !!}

        <hr>

        <form method="POST" action="{{ action('UserController@update') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <p>Name</p>
                </div>
                <div class="col-md-4">
                    <p>Email</p>
                </div>
                <div class="col-md-4">
                    <p>Status Song</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="text-input" name="name" value="{{ session('user')->name }}">
                </div>
                <div class="col-md-4">
                    <input type="email" class="text-input" name="username" value="{{ session('user')->email }}" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                </div>
                <div class="col-md-4">
                <select multiple name="status_song[]">
                    @forelse (session('user')->song as $song)
                    @if ($song->id === session('user')->song_status->id)
                    <option value="{{ $song->id }}" selected>{{ $song->name }}</option>
                    @else
                    <option value="{{ $song->id }}">{{ $song->name }}</option>
                    @endif
                    @empty
                    <option value="empty">No Songs Available</option>
                    @endforelse
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>Lastname</p>
                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    <p>Birthday</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="text-input" name="lname" value="{{ session('user')->lastname }}">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Update Information">
                </div>
                <div class="col-md-4">
                    <input type="date" class="text-input" name="birthday" value="{{ substr(session('user')->birthday, 0, 10) }}">
                </div>
            </div>
        </form>
    </div>

    <div class="general-floor"></div>

@endsection