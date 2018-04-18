
@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')

        <div>
            <h3 style="text-align: center;">New Name</h3>
        </div>
        <form method="POST" action="{{ route('changeGN',['id' => $id ]) }}">
        {{ csrf_field() }}
        <div>
            <div style="text-align: center;margin-top: 5%;">
                <p> Name </p>
                <input type="text" id="new-group-name" name="newgroupname" style="width:50%"> 
            </div>
                <div style="text-align: center; margin-top: 5%;">
                    <button type="sumbmit" > Send </button>
                </div>
            </form>
        </div>

@endsection