@extends('general')

@section('title', "Sign Up")

@section('content')

<section class="page-section cta">
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
                <div class="container">

                    <h2 class="section-heading mb-0">
                        <span class="section-heading-upper">We want to hear from you</span>
                        <span class="section-heading-lower">Sign Up!</span>
                    </h2>
                    <hr>

                    <form method="POST" action="{{ action('UserController@signup') }}" name="signup">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 offset-md-4">

                                <div id="name-and-lname">
                                    <div id="name-input">
                                        <p>Name</p>
                                        <input type="text" class="text-input" name="name">
                                    </div>
                                    <div id="lname-input">
                                        <p>Last Name</p>
                                        <input type="text" class="text-input" name="lname">
                                    </div>
                                </div>
                                <p>Email</p>
                                <input type="email" class="text-input" name="username" oninvalid="this.setCustomValidity('Please, insert a valid email.')">
                                <p>Password</p>
                                <input type="password" class="text-input" name="password">
                                <p>Birthday</p>
                                <input type="date" class="text-input" name="birthday">
                                <hr>
                                <div style="text-align: center; margin-top: 20px;">
                                    <input type="submit" value="Sign Up">
                                    <input type="submit" name="submitted" value="Cancel" style="margin-top:1%" onclick="/">
                                </div>

                                @if (session('signupfail') !== null)
                                <hr>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Sign Up failed!
                                    <br>
                                    There are errors in one or more fields.
                                </div>
                                @elseif (session('signupfailuserexists') !== null)
                                <hr>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Sign Up failed!
                                    <br>
                                    User already exists.
                                </div>
                                @elseif (session('signupfailemptyfield') !== null)
                                <hr>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> Sign Up failed!
                                    <br>
                                    There can't be any empty fields.
                                </div>
                                @endif

                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection