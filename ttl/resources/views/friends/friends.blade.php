@extends('general')

@section('title', "Friends")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/friends.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')
        
    <h2 style="text-align: center;">Add Friends</h2>

    <hr>
    
    <form method="POST" action="{{ action ('FriendsController@addFriend') }}">
    {{ csrf_field() }}
    <div id="new-friend" style="margin-top: 5%">
        <div id="email">
            <div style="width: 50%;float: right;">
                <p>Email</p>
                <input type="email" name="email" id="emailInput"><br><br>
                <input type="checkbox" id="cbox" value="send_hello" disabled checked> Send Message Saying "Hello"
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
    </form>

    @if (count($friends) != 0)
    <hr>
    
    <div id="pagination-box-style" class="ajax-pagination" style="margin-top: 5%">
        @include('friends.friends-pag', ['friends' => $friends])
    </div>

    @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Friends'])

    @endif

        
        
@endsection