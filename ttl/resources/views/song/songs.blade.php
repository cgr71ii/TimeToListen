@extends('general')

@section('title', "Songs")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">You're an artist!</span>
                        <span class="section-heading-lower">Add Songs</span>
                    </h2>
                    
                    <hr>
                    
                    {!! Form::open(array('route' => 'song.add_song','files'=>true)) !!}
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-3 offset-md-1">
                            <p class="mb-0"> Name: </p>
                            <input type="text" class="text-input" name="song_name">
                            <p class="mb-0"><br> Song (wav format): </p>
                            <div>
                                {!! Form::file('file') !!}
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-2">
                            <p class="mb-0"> Genre: </p>
                            <select name="chosen_genres[]" size="6" multiple>
                                @foreach (session('genres') as $genre)
                                <option value ="{{ $genre->id }}"> {{ $genre->name }} </option>
                                @endforeach
                            </select>
                            <p class="mb-0">Hold down the Ctrl (windows) / <br>
                                Command (Mac) button to select multiple options.</p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <br>
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
                    <br>
                    <div class="alert alert-danger">
                        <h5> There were errors with the song upload petition: </h5>
                        <ul>
                            <li> There are empty fields that need to be completed. </li>
                        </ul>
                    </div>
                    @endif
                    @if (session('errorfile') !== null)
                    <br>
                    <div class="alert alert-danger">
                        <h5> There were errors with the song upload petition: </h5>
                        <ul>
                            <li> The file format must be wav. </li>
                        </ul>
                    </div>
                    @endif
                    @if (session('success') !== null)
                    <br>
                    <div class="alert alert-success">
                        <h5> The song has been successfuly uploaded! </h5>
                    </div>
                    @endif

                    <br>

                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div>
                                {!! Form::submit('Upload Song') !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <hr>
            </div>
        </div>
    </div>
</section>

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Your masterpieces!</span>
                        <span class="section-heading-lower">Song List</span>
                    </h2>

                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                            @if (session('songs')[0] !== null)
                            <hr>
                            <div id="pagination-box-style" class="ajax-publication">
                                @include('song.songs-pag', ['songs' => session('songs')])
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

@endsection