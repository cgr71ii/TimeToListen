@extends('general', ['menu' => false])

@section('title', 'Profile')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/errors.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')

<section class="page-section cta" style="background: none;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <div id="error-container">
                                <div id="container">
                                    <h2 class="section-heading mb-4">
                                        <span class="section-heading-lower">Error 404</span>
                                    </h2>
                                    <hr>
                                    <p>It looks like if that song was not in our database...</p><br>
                                    <p>Try Again!</p>
                                    <p><img src="{{ asset('favicon.png') }}"><a href="{{ action('UserController@show') }}">https://www.timelisten.com/</a><img src="{{ asset('favicon.png') }}"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection