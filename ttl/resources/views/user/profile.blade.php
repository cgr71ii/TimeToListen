@extends('general')

@section('title', "Profile")

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="css/profile.css">
@endsection

@section('content')
    <!--All body code here.-->

    <div id="user-info-wrapper">
        <div id="user-info-img">
            <img src="default-user.png" alt="User Image">
        </div>
        <div id="user-info-content">
            <p>user info content</p>
        </div>
    </div>
    <div id="write-pub">
        <p>Write pubs</p>
    </div>
    <div id="publications">
        <p>Pubs</p>
    </div>
@endsection