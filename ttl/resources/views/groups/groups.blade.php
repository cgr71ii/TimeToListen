@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')

<h2 style="text-align: center;">New Group</h2>

<hr>

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
                            <option value="{{ $friend->id }}">{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                        </div>
                        
                    @empty  
                        <li>You Don't Have Any Friend</li>
                    
                    @endforelse
                    <option value="allfriends" selected> All Friends </option>
                </div>
            </select>
        </div> 
        <div style="text-align: center; margin-top: 5%;">
            <button type="submit" > Send </button>
        </div>
    </div>
</form>

@if (count($groups) != 0)

<hr>

<div id="pagination-box-style" class="ajax-pagination">
    @include('groups.groups-pag', ['groups' => $groups])
</div>

@include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Groups'])

@endif

@endsection