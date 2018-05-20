@extends('general')

@section('title', "Contact")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            <h2 class="section-heading mb-0">
                                <span class="section-heading-upper">We value your opinion</span>
                                <span class="section-heading-lower">Contact Us!</span>
                            </h2>

                            <hr>

                                <form method='post' action="{{ action('MailController@sendContactEmail') }}">
                                {{ csrf_field() }}
                                        <p>First Name</p>
                                        <input type="text" id="fname" name="firstname" placeholder="Your name...">
                                        <br>
                                        <p>Last Name</p>
                                        <input type="text" id="lname" name="lastname" placeholder="Your last name...">
                                        <br>
                                        <p>Email</p>
                                        <input type="email" id="email" name="email" placeholder="Your Email...">   
                                        <br>
                                        <hr>
                                        <label for="subject">Subject</label>
                                        <textarea id="subject" name="subject" placeholder="Write something..." style="height: auto; width:100%;" rows="6"></textarea>

                                        <hr>
                                        <input type="submit" value="Submit">
                                        @if (session('fail') !== null)
                                            <hr>
                                            <div class="alert alert-danger">
                                                <strong>Sending failed! There can't be any empty fields.</strong>
                                            </div>

                                        @elseif (session('sent') !== null)
                                            <hr>
                                            <div class="alert alert-success">
                                                <strong>Message sent</strong>
                                            </div>
                                        @endif
                                        <hr>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection