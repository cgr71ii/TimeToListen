@extends('general')

@section('title', "Groups")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">Be creative together!</span>
                                <span class="section-heading-lower">Create Group</span>
                            </h2>
                            
                            <hr>
                            
                            <form method="POST" action="{{ action ('GroupController@createGroup') }}">
                                {{ csrf_field() }}
                                <div id="new-group">
                                            <div style="text-align: center;">
                                                <p> Name: </p>
                                                <input type="text" id="new-group-name" name="newgroupname"> 
                                                @if (session('error')!=null)
                                                    <hr>
                                                    <div class="alert alert-danger">
                                                        <strong>Error!</strong> Something unexpected happened.
                                                    </div>
                                                @elseif (session('errorEmpty'))
                                                    <hr>
                                                    <div class="alert alert-danger">
                                                        <strong>Error!</strong> Can't be empty fields.
                                                    </div>
                                                @elseif (session('new_group'))
                                                    <hr>
                                                    <div class="alert alert-success">
                                                        <h5> The group {{ session('new_group') }} has been successfuly created! </h5>
                                                    </div>
                                                @endif
                                            </div>
                                    <br>
                                            <div id="block">
                                                <p>Select Friends</p>
                                            </div>
                                                <select multiple name="friend_list[]" style="overflow-y: scroll;">
                                                    
                                                    <div id="list-friends">
                                                        @forelse ($friends as $friend)
                                                            <div id="friend">
                                                                <option value="{{ $friend->id }}">{{ $friend->name }} {{$friend->lastname}}  ({{ $friend->email }})</option>
                                                            </div>
                                                            
                                                        @empty  
                                                            <li>You Don't Have Any Friends</li>
                                                        
                                                        @endforelse
                                                        <option value="allfriends" selected> All Friends </option>
                                                    </div>
                                                </select>
                                    <div class="row">
                                        <div class="col-md-4 offset-md-4">
                                            <div>
                                                <br>
                                                {!! Form::submit('Create Group') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div style="height: 100px;"></div>

@if (count($groups) != 0)
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Right where you belong</span>
                        <span class="section-heading-lower">Group List</span>
                    </h2>

                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                        @if (count($groups) != 0)

                        <hr>

                        <div id="pagination-box-style" class="ajax-pagination">
                            @include('groups.groups-pag', ['groups' => $groups])
                        </div>

                        @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Groups'])

                        @endif
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endif

</section>

@endsection