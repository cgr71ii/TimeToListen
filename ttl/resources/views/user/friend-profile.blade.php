@extends('general')

@section('title', 'Friend Profile')

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">{{ session('friend')->name }} {{ session('friend')->lastname }}</span>
                    </h2>
                    
                    <hr>
                    
                    <div id="user-info-wrapper">
                        <div id="user-info-img">
                            @if (File::exists(session('friend')->pic_profile_path))
                            <img width="300" height"400"  src="{{ asset(session('friend')->pic_profile_path) }}" alt="User Image">
                            @else
                            <img width="300" height"400"  src="{{ asset('default-user.png') }}" alt="User Image">
                            @endif
                        </div>
                        <div id="user-info-content">
                        <br>
                        <br>
                            <div id="user-info-content-wrapper">
                            @if (session('friend')->song_status !== null)
                            <p><img width="32" height"32" src="{{ asset('favicon.png') }}"> {{ session('friend')->song_status->name }} <img width="32" height"32" src="{{ asset('favicon.png') }}"></p>
                            @if (Auth::user()->song_status !== null && File::exists(session('friend')->song_status->song_path))
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <audio style="width:350px;" controls id="myaudio"><source src="{{ asset(session('friend')->song_status->song_path) }}" type="audio/mp3">Audio not Available!</audio>

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
                        </div>
                    </div>

                    <hr>
                </div>
            </div>
        </div>
    </div>

<div style="height: 100px;"></div>

@if (session('friend_publications')[0] !== null)
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">

                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            @if (session('friend_publications')[0] !== null)
                                
                                <div id="pagination-box-style" class="ajax-publication">
                                    @include('publication.publications', ['actions' => false])
                                </div>
                            @endif

                            @include('pagination-ajax', ['class_name' => 'ajax-publication', 'object_title' => 'Friend Publications'])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif

</section>

@endsection