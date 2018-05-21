@extends('general')

@section('title', 'Settings')

@section('content')
    
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                    </h2>
                    <hr>
                    <div id="user-info-wrapper">
                        <div id="user-info-img">
                            @if (File::exists(Auth::user()->pic_profile_path))
                            <img width="300" height"400" src="{{ Auth::user()->pic_profile_path }}" alt="User Image">
                            @else
                            <img width="300" height"400" src="default-user.png" alt="User Image">
                            @endif
                        </div>
                        <br>
                        <div id="user-info-content">
                            <div id="user-info-content-wrapper">

                                <div class="row">
                                    <div class="col-md-12 offset-md-0">
                                        @if (Auth::user()->song_status !== null)
                                        <p><img width="32" height"32" src="favicon.png"> {{ Auth::user()->song_status->name }} <img width="32" height"32" src="favicon.png"></p>
                                        @if (Auth::user()->song_status !== null && File::exists(Auth::user()->song_status->song_path))
                                        <audio style="width:350px;" controls id="myaudio"><source src="{{ Auth::user()->song_status->song_path }}" type="audio/wav">Audio not Available!</audio>

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
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-12 offset-md-0">
                                        <a href="{{ action('UserController@logout') }}">Sign Out</a>
                                    </div>
                                </div>
                            </div>
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
                                    <input type="text" class="text-input" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="email" class="text-input" name="username" value="{{ Auth::user()->email }}" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                                </div>
                                <div class="col-md-4">
                                <select multiple name="status_song[]">
                                    @forelse (Auth::user()->song as $song)
                                    @if (Auth::user()->song_status !== null && $song->id === Auth::user()->song_status->id)
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
                                    <input type="text" class="text-input" name="lname" value="{{ Auth::user()->lastname }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Update Information">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="text-input" name="birthday" value="{{ substr(Auth::user()->birthday, 0, 10) }}">
                                </div>
                            </div>
                        </form>
                        
                        <br>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection