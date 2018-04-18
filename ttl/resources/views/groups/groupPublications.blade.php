@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" type="text/css" href="/css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <!--All body code here.-->
    <div>
        <h3 style="text-align: center;">
            {{ $group->name }}
        </h3>
        <p style="margin-bottom: 4%;text-align: center;">
            @if( $changeP  == true)
                <a href="{{ URL::to('/groups')}}/{{$group->id}}/changeName" style="font-size:75%;color: red;" > Change Name </a>
            @endif
        </p>
    </div>

    <div id="members">
        <div id="add-friend">
            <h4 style="text-align: center;">Add Friend</h4>
            <form method="POST" action="{{ route('my_route',['id' => $group->id ]) }}">
            {{ csrf_field() }} 

            <input type="hidden" name="group_id" value = {{ $group->id }}></input>
            <div class="selection"> 
                <div class="block">
                    <p class="text">Select Friends</p>
                </div>
                <select multiple name="friend_list[]" style="width: 100%;height: 200px;">
                    <div class="list-friends">
                        @forelse ($friends as $friend)
                            <div>
                                <option value="{{ $friend->id }}" selected>{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                            </div>
                            
                        @empty  
                            <li>You Don't Have Any Friend</li>
                        
                        @endforelse
                        <option value="allfriends" selected> All Friends </option>
                    </div>
                </select>
            </div>
            <div style="text-align: center;margin-top: 5%;">
                <button type="sumbmit" id="button"> Send </button>
            </div>
            </form>
        </div>
        <div id="belong">
            <h4 style="text-align: center;">Belong To The Group</h4>
            <div class="selection"> 
                <div class="block">
                    <p class="text">Friends</p>
                </div>
                <div class="list-friends">
                    @forelse ($members as $member)
                        <div>
                            @if ($member->id == session('user')->id)
                                <p><a href="{{ URL::to('/profile') }}">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                            @else
                                <p><a href="{{ URL::to('/profile') }}/{{$member->email }}">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                        
                            @endif
                        </div>
                        
                    @empty  
                        <li>You Don't Have Any Friend</li>
                    
                    @endforelse
                </div>
            </div>
            <div style="text-align: center;margin-top: 5%;">
                <a href="{{ URL::to('/groups')}}/{{$group->id}}/exit" style="margin-left: 10%;color: red"> Click here to leave the group </a>
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
                <li>You Don't Have Any Publication</li>
            
            @endforelse
    </div>
    

@endsection