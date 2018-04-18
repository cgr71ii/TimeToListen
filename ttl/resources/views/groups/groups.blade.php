@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')

        <div>
            <h3 style="text-align: center;">New Group</h3>
        </div>
        <form method="POST" action="{{ action ('GroupController@createGroup') }}">
        {{ csrf_field() }}
        <div id="new-group">
            <div style="text-align: center;margin-top: 5%;">
                <p> Name </p>
                <input type="text" id="new-group-name" name="newgroupname" style="width:50%"> 
            </div>
            <div class="selection">
                <select multiple name="friend_list[]" style="width: 100%;height: 200px;overflow-y: scroll;">
                    <div id="block">
                        <p id="text">Select Friends</p>
                    </div>
                    <div id="list-friends">
                        @forelse ($friends as $friend)
                            <div id="friend">
                                <option value="{{ $friend->id }}" selected>{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                            </div>
                            
                        @empty  
                            <li>You Don't Have Any Friend</li>
                        
                        @endforelse
                        <option value="allfriends" selected> All Friends </option>
                    </div>
                </select>
            </div> 
                <div style="text-align: center; margin-top: 5%;">
                    <button type="sumbmit" > Send </button>
                </div>
            </form>
            <div id="list-groups">
                <h4 style="text-align: center;margin-top: 5%"> My Groups </h4>
                @forelse ($groups as $group)
                    <div style=" margin-left: 20%;">
                        <p>
                            <a href="{{ URL::to('/groups')}}/{{$group->id}}">{{ $group->name }}</a>
                            <a href="{{ URL::to('/groups')}}/{{$group->id}}/exit" style="margin-left: 10%;color: red"> Click here to leave the group </a>
                        </p>
                    </div>
                    
                @empty  
                    <li>You Don't Have Any Group</li>
                
                @endforelse
            </div>
        </div>

@endsection