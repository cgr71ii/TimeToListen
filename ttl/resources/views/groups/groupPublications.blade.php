@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/general.css">
    <link rel="stylesheet" type="text/css" href="/css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')
    <!--All body code here.-->

    <h2 style="text-align: center;">{{ $group->name }}</h2>
    
    @if (session('user')->id == $group->creator_id)
    <p style="margin-bottom: 4%;text-align: center;">
        <a href="{{ action('GroupController@showChangeName', ['id' => $group->id]) }}" style="font-size:75%;color: red;" >Change Name</a>
    </p>
    @endif

    <div id="members">
        <div id="add-friend">
            <h4 style="text-align: center;">Add Friend</h4>
            
            <form method="POST" action="{{ route('my_route',['id' => $group->id ]) }}">
                {{ csrf_field() }} 

                <input type="hidden" name="group_id" value = {{ $group->id }}>
                <div class="selection"> 
                    <div class="block">
                        <p class="text">Select Friends</p>
                    </div>
                    <select multiple name="friend_list[]" style="width: 100%;height: 200px;">
                        @foreach ($friends as $friend)
                        <option value="{{ $friend->id }}">{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                        @endforeach
                        <option value="allfriends" selected> All Friends </option>
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
                @foreach ($members as $member)
                @if ($member->id == session('user')->id)
                <p><a href="{{ action('UserController@show') }}">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                @else
                <p><a href="{{ action('UserController@showFriend', ['email' => $member->email]) }}">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>

    @if (count($publications) != 0)
    <div id="pagination-box-style" class="ajax-pagination">
        @include('groups.group-publications-pag')
    </div>
    
    @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'Group Publications'])
    @endif

@endsection