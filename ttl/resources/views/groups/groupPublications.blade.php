@extends('general')

@section('title', "Groups")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">{{ $group->name }}</span>
                    </h2>

                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            @if (Auth::user()->id == $group->creator_id)
                            <p style="margin-top: -10%;text-align: center;">
                                <a href="{{ action('GroupController@showChangeName', ['id' => $group->id]) }}" style="font-size:75%;color: blue;" >Change Name</a>
                            </p>
                            @endif
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            <h4 style="text-align: center;">Add Friend</h4>
                            <hr>
                            
                            <form method="POST" action="{{ route('my_route',['id' => $group->id ]) }}">
                                {{ csrf_field() }} 
                                <input type="hidden" name="group_id" value = {{ $group->id }}>
                                <div>
                                    <select multiple name="friend_list[]">
                                        @foreach ($friends as $friend)
                                        <option value="{{ $friend->id }}">{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                                        @endforeach
                                        <option value="allfriends" selected> All Friends </option>
                                    </select>
                                </div>
                                <div style="text-align: center;margin-top: 5%;">
                                    {!! Form::submit('Add To Group') !!}
                                </div>
                            </form>
                        </div>
                    
                        <div class="col-md-12 offset-md-0">
                            <hr style="margin-top: 5%;">
                            <h4 style="text-align: center;">Belong To The Group</h4>
                            <hr>
                            @foreach ($members as $member)
                                @if ($member->id == Auth::user()->id)
                                <p><a href="{{ action('UserController@show') }}" style="color: blue;" >{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                                @else
                                <p><a href="{{ action('UserController@showFriend', ['email' => $member->email]) }}" style="color: blue;">{{ $member->name }} {{$member->lastname}} ({{ $member->email }})</a></p>
                                @endif
                            @endforeach
                        </div>
                    </div>

            </div>
        </div>
    </div>
    
<div style="height: 100px;"></div>

@if (count($publications) != 0)
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            @if (count($publications) != 0)
                                <div id="pagination-box-style" class="ajax-pagination">
                                    @include('groups.group-publications-pag')
                                </div>
                                
                                @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'Group Publications'])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

</section>

@endsection