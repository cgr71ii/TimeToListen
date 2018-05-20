@extends('general')

@section('title', "Contact")

@section('content')

<section class="page-section cta">
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
                <div class="container">

                    <h2 class="section-heading mb-0">
                        <span class="section-heading-upper">We value your opinion</span>
                        <span class="section-heading-lower">Contact Us!</span>
                    </h2>

                    <hr>

                    <div class="row">
                        <form method='post' action="{{ action('MailController@sendContactEmail') }}">
                        {{ csrf_field() }}
                            <div class="col-md-11 offset-md-1">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="firstname" placeholder="Your name...">

                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lastname" placeholder="Your last name...">

                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Your Email...">   
                            </div>

                            <div class="col-md-11 offset-md-1">
                                <hr>
                                <label for="subject">Subject</label>
                                <textarea id="subject" name="subject" placeholder="Write something..." style="height: auto; width:100%;" rows="6"></textarea>
                            </div>
                            <div class="col-md-11 offset-md-1">
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
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection