@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/groups.css">
@endsection

@section('content')

        <div>
            <h3 style="text-align: center;">New Group</h3>
        </div>
        <div id="new-group">
            <p> Name </p>
            <input type="text" id="new-group-name"> 
            <div id="selection">
                <div id="block">
                    <p id="text">Select Friends</p>
                </div>
                <div id="list-friends">
                    @forelse ($friends as $friend)
                        <div id="friend">
                            <p>{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</p>
                        </div>
                        
                    @empty  
                        <li>You Don't Have Any Friend</li>
                    
                    @endforelse
                    <p> All Friends </p>
                </div>
            </div> 
            <form method="POST" action="{{ action ('GroupController@createGroup') }}">
                {{ csrf_field() }}
                <div style="text-align: center; margin-top: 5%;">
                    <button type="sumbmit" > Send </button>
                </div>
            </form>
            <div id="list-groups">
                <h4 style="text-align: center;margin-top: 5%"> My Groups </h4>
                @forelse ($groups as $group)
                    <div style=" margin-left: 20%;">
                        <p><a href="{{ URL::to('/groups')}}/{{$group->id}}">{{ $group->name }}</a></p>
                    </div>
                    
                @empty  
                    <li>You Don't Have Any Group</li>
                
                @endforelse
            </div>
        </div>

@endsection