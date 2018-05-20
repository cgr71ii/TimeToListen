@extends('general')

@section('title', "Friends")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/friends.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">Add Friends</span>
                    </h2>

                    <hr>

                    <form method="POST" action="{{ action ('FriendsController@addFriend') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6 offset-md-0">
                            <p>Email</p>
                            <input type="email" name="email" id="emailInput"><br><br>
                            <input type="checkbox" id="cbox" value="send_hello" disabled checked> Send Message Saying "Hello"
                        </div>
                        <div class="col-md-6 offset-md-0">
                            <p>Additional Text For Message</p>
                            <textarea id="text-area" maxlength="300" name="additional"> </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                        <button type="submit">Send</button>
                        </div>
                    </div>
                    
                    </form>

                </div>
            </div>
        </div>
        <div id="message">
            <p>Additional Text For Message</p>
            <textarea id="text-area" maxlength="300" name="additional"> </textarea>
        </div>
    </div>
        @if (session('errorEmail')!=null)
            <hr>
            <div class="alert alert-danger">
                <strong>Error!</strong> The user {{ session('errorEmail') }} does not exist.
            </div>
        @elseif (session('errorSelfFriend'))
            <hr>
            <div class="alert alert-danger">
                <strong>Error!</strong> This is your email.
            </div>
        @elseif (session('errorAlreadyFriend'))
            <hr>
            <div class="alert alert-danger">
                <strong>Error!</strong> The user {{ session('errorAlreadyFriend') }} is already your friend.
            </div>
        @endif
    <div id=button>
            <button type="submit">Send</button>
    </div>
</section>

@if (count($friends) != 0)
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">My Friends</span>
                    </h2>

                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                            <div id="pagination-box-style" class="ajax-pagination" style="margin-top: 5%">
                                @include('friends.friends-pag', ['friends' => $friends])
                            </div>

                            @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Friends'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
        
        
@endsection