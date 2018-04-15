@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" type="text/css" href="/css/groups.css">
@endsection

@section('content')
    <!--All body code here.-->
    <div>
        <h3 style="text-align: center;">{{ $group->name }}</h3>
    </div>

    <div id="members">
        <div id="add-friend">
            <h4 style="text-align: center;">Add Friend</h4>
            <div id="selection"> 
                <div id="block">
                    <p id="text">Select Friends</p>
                </div>
                <div id="list-friends">
                    @forelse ($friends as $friend)
                        <div id="friend">
                            <p>{{ $friend->name }} {{$friend->lastname}} ({{ $friend->email }})</p>
                        </div>
                        
                    @empty  
                        <li>You Don't Have Any Friend</li>
                    
                    @endforelse
                    <p> All Friends </p>
                </div>
            </div>
            <div style="text-align: center;margin-top: 5%;">
                <button id="button"> Send </button>
            </div>
        </div>
        <div id="belong">
            <h4 style="text-align: center;">Belong To The Group</h4>
            <div id="selection"> 
                <div id="block">
                    <p id="text">Friends</p>
                </div>
                <div id="list-friends">
                    @forelse ($members as $member)
                        <div id="friend">
                            <p><a href="{{ URL::to('/profile') }}/{{$member->email }}">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                        </div>
                        
                    @empty  
                        <li>You Don't Have Any Friend</li>
                    
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div id="publications">
            <h4 style="text-align: center;"> Publications </h4>
            @forelse ($publications as $publication)
                <div>
                    <p>Message From: {{$publication->name}} {{$publication->lastname}} ({{$publication->email}})</p>
                    <p>Date: {{$publication->date}}</p>
                    <div style="border: 2px solid black; overflow-y: scroll;" >
                        <a>{{$publication->text}}</a>
                    </div>
                    <div style="text-align: right;">
                        <a> Extend </a>
                        <a> Delete </a>
                    </div>
                </div>
                
            @empty  
                <li>You Don't Have Any Friend</li>
            
            @endforelse
    </div>
    

@endsection