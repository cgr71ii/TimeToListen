@extends('general')

@section('title', "Friends")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/friends.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
        
    <div>
        <h3 style="text-align: center;">Add Friends</h3>
    </div>
    
    <form method="POST" action="{{ action ('FriendsController@addFriend') }}">
    {{ csrf_field() }}
    <div id="new-friend" style="margin-top: 5%">
        <div id="email">
            <div style="width: 50%;float: right;">
                <p>Email</p>
                <input type="email" name="email" id="emailInput"> </input></br></br>
                <input type="checkbox" id="cbox" value="send_hello"> Send Message Saying "Hello"</label>
            </div>
        </div>
        <div id="message">
            <p>Additional Text For Message</p>
            <textarea id="text-area" maxlength="300" name="additional"> </textarea>
        </div>
    </div>
    <div id=button>
            <button type="submit" value"Send Message">Send</button>
    </div>
    </form>

    <div id="friend-list" style="margin-top: 5%">
        <h3 style="text-align: center;margin-top: 5%;">My Friends</h3>
     
        @forelse ($friends as $friend)
            <div class="friend">
                <div style="margin-left: 15%;text-align: center;float: left;width: 50%;">
                    <!-- The conditinal it will check if session('user')->pic_profile_path exists -->
                    @if (File::exists(session('user')->pic_profile_path))
                    <img src="{{ asset($friend->pic_profile_path) }}" alt="User Image" class="friend-image">
                    @else
                    <img src="{{ asset('default-user.png') }}" alt="User Image" class="friend-image">
                    @endif
                </div>
                <div class="friend-text">
                    <p><a href="{{ URL::to('/profile') }}/{{$friend->email }}">{{ $friend->name }} {{$friend->lastname}}</a></p>
                    <p>{{ $friend->email }}</p>
                    <p><a href="{{ URL::to('/message/send')}}">Send Message</a></p>
                    <p><a href="{{ URL::to('/songs') }}/{{$friend->email }}">Songs</a></p>
                    <p><a href="{{ URL::to('/deleteFriend') }}/{{$friend->email }}">Delete Friend</a></p>
                </div>
                
            </div> 
                
        @empty  
                <li>You Don't Have Any Friend</li>
            
        @endforelse



    </div>

        
        
@endsection