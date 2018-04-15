@extends('general')

@section('title', "Friends")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/friends.css">
@endsection

@section('content')
        
    <div>
        <h3 style="text-align: center;">Add Friends</h3>
    </div>
    
    <form method="POST" action="{{ action ('FriendsController@addFriend') }}">
    {{ csrf_field() }}
        <div id="new-friend">
            <div id="email">
                <p>Email</p>
                <input type="email" name="email"> </input></br></br>
                <input type="checkbox" id="cbox" value="send_hello"> Send Message Saying "Hello"</label>
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

    <div id="friend-list">
        <h3 style="text-align: center;">My Friends</h3>
     
        @forelse ($friends as $friend)
            <div id="friend">
                <div id="friend-image">
                    <p>IMAGEN</p>
                </div>
                <div id="friend-text">
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