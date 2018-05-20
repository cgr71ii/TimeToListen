@extends('general')

@section('title', 'Messages')

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-lower">Send Message</span>
                            </h2>
                            <hr>

                            <div class="write-pub">
                                @if (session('sendfail') !== null)
                                        <hr>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> Please fill in all fields!
                                        </div>
                                @endif
                                <p style="float: left;"> Select your friends:</p>
                                <form method="POST" action="{{ action('MessageController@create') }}">
                                    {{ csrf_field() }}
                                    <select name="receptors[]" multiple class="pagination-content-wrapper">
                                        <!--<option value="all">All Friends</option>-->
                                        @foreach($friends as $friend)
                                        @if (isset($friend_email) && $friend->email == $friend_email)

                                        $text = str_replace(' ', '_', $text);
                                        <option value='{{$friend->id}}' selected>{{$friend->name}} {{$friend->lastname}}</option>
                                        @else
                                        <option value='{{$friend->id}}'>{{$friend->name}} {{$friend->lastname}}</option>
                                        @endif
                                        @endforeach
                                        
                                        @if (isset($friend_email))
                                        <option value="all_friends">All Friends</option>
                                        @else
                                        <option value="all_friends" selected>All Friends</option>
                                        @endif
                                    </select>
                                    <br>
                                    <span style="float:left;">Title</span>
                                    <br>
                                    <textarea style="height: auto; width:100%;" rows="1" cols="10" name="title"></textarea>
                                    <br>
                                    <span style="float:left;">Body of Message</span>
                                    <br>
                                    <!--<input class="pagination-content-wrapper" name="body" type="text">-->
                                    <textarea style="height: auto;" rows="10" cols="50" name="body"></textarea>
                                    <br>
                                    <div id="button_send">
                                        <input type="submit" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($messages_sent_count != 0 || $messages_recv_count != 0)
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-md-12 offset-md-0">
                            @if ($messages_sent_count != 0)
                            <div class="write-pub" style="margin-bottom: 20px;">
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-upper">Sent Messages</span>
                                </h2>

                                <a href="{{ action('MessageController@listSentMessages') }}">Read my sent messages</a>
                            </div>
                            @endif

                            @if ($messages_recv_count != 0)
                                @if ($messages_sent_count != 0)
                                <hr>
                                @endif
                            <div class="write-pub" style="margin-bottom: 20px;">
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-upper">Received Messages</span>
                                </h2>

                                <a href="{{ action('MessageController@listReceivedMessages') }}">Read my received messages</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection