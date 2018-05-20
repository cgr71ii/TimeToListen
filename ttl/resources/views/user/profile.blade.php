@extends('general')

@section('title', 'Profile')



@section('content')
    <!--All body code here.-->

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                    </h2>
                    <hr>

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
                            <!-- The conditinal it will check if Auth::user()->pic_profile_path exists -->
                            @if (File::exists(Auth::user()->pic_profile_path))
                            <img width="300" height="300" src="{{ Auth::user()->pic_profile_path }}" alt="User Image">
                            @else
                            <img width="300" height="300" src="default-user.png" alt="User Image">
                            @endif
                        </div>
                        <div id="user-info-content">
                            <div id="user-info-content-wrapper">
                                <br>
                                @if (Auth::user()->song_status !== null)
                                <p><img width="32" height="32" src="favicon.png"> {{ Auth::user()->song_status->name }} <img width="32" height="32" src="favicon.png"></p>
                                
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
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
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                <p>Click <a href="{{ action('UserController@showSettings') }}">here</a> to modify your profile!</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="write-pub">
                                <hr>
                                
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-upper">New Publication</span>
                                </h2>
                                
                                @if (session('create_publication_fail') !== null)
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Publication can not have empty fields!
                                </div>
                                @endif
                                <form method="POST" action="{{ action('PublicationController@create') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1"> 
                                            <textarea style="height: auto; width:100%;" rows="4"  name="publication"></textarea><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10 offset-md-1"> 
                                            <select name="publication_group" style="float: center;">
                                                <option value="own_publication">Own Publication</option>
                                                @foreach (Auth::user()->group_user as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                                @if (count(Auth::user()->group_user) != 0)
                                                <option value="all_groups">All Groups</option>
                                                @endif
                                            </select>
                                            <input type="submit" value="Publicate">
                                        </div>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('publications')[0] !== null)
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 mx-auto">
                <div class="cta-inner text-center rounded">

                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                        @if (session('publications')[0] !== null)
                        <hr>
                        <div id="pagination-box-style" class="ajax-publication">
                            @include('publication.publications', ['actions' => true, 'group_notify' => true])
                        </div>
                        @endif

                        @include('pagination-ajax', ['class_name' => 'ajax-publication', 'object_title' => 'Publications'])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endif
    
    

@endsection