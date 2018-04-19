
@extends('general')

@section('title', "Groups")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/groups.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')

<h3 style="text-align: center;">New Name</h3>

<form method="POST" action="{{ action('GroupController@updateOnlyName') }}">
    {{ csrf_field() }}

    <input type="hidden" name="group_id" value="{{ $id }}">

    <div style="text-align: center;margin-top: 5%;">
        <p>Name </p>
        <input type="text" id="new-group-name" name="name" style="width:50%"> 
    </div>
    <div style="text-align: center; margin-top: 5%;">
        <input type="submit" value="Send">
    </div>
</form>

@endsection