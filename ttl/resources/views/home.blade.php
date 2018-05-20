@extends('general')

@section('title', "Sign Up")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="col-xl-12 mx-auto">
            <div class="cta-inner text-center rounded">
                <div class="row">

                    <div class="row">
                        <div id="information" class="col-md-7">
                            <h2 class="section-heading mb-0">
                                <span class="section-heading-upper">We want to hear from you</span>
                            </h2>
                            <div style="margin-top:5%; font-size: 20px">
                                <p style="text-size: 15px">Connect with people you know or make new friends and bond through the
                                    power of music.</p>
                                <p style="text-size: 20px">Discover, stream, and share a constantly expanding mix of music from 
                                    emerging and major artists around the world.</p>
                            </div>

                        </div>
                        <div id="log-in" class="col-md-4">
                            <div id="log-in-content">

                                <form method="POST" action="{{ action('UserController@show') }}">
                                    {{ csrf_field() }}
                                    <div><p>Email</p></div>
                                    @if (Cookie::get('TTLusername') !== null)
                                    <input type="email" class="text-input" name="username" value="{{ Cookie::get('TTLusername') }}" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                                    @else
                                    <input type="email" class="text-input" name="username" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                                    @endif
                                    <p>Password</p>
                                    @if (Cookie::get('TTLpassword') !== null)
                                    <input type="password" class="text-input" name="password" value="{{ Cookie::get('TTLpassword') }}">
                                    @else
                                    <input type="password" class="text-input" name="password">
                                    @endif
                                    
                                    <p>Remember me: <input type="checkbox" style="width: 20px;" name="remember"></p>
                                    
                                    <div style="text-align: center; margin-top: 20px;">
                                        <input type="submit" value="Log In">
                                    </div>
                                </form>
                                @if (session('loginfail') !== null)
                                <hr>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Log In failed!
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection