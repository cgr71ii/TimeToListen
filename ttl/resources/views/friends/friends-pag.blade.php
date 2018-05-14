
<h2>My Friends</h2>

<hr>

<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('FriendsController@show') }}">
        {{ csrf_field() }}
        <select name="field" form="order-form">
            <option value="created_at">Created At</option>
            <option value="updated_at">Updated At</option>
            <option value="name">Name</option>
            <option value="email">Email</option>
        </select>

        <select name="direction" form="order-form">
            <option value="asc">Ascendent</option>
            <option value="desc">Descendent</option>
        </select>
        
        <input type="hidden" name="order-form">
        <input type="submit" value="Order">
    </form>
</div>

<hr>

@if (count($friends) != 0)
<span class="link-pagination">
    {{ $friends->links() }}
</span>
@endif

@foreach ($friends as $friend)
    <div class="friend">
        <div style="margin-left: 15%;text-align: center;float: left;width: 50%;">
            <!-- The conditinal it will check if Auth::user()->pic_profile_path exists -->
            @if (File::exists(Auth::user()->pic_profile_path))
            <img src="{{ asset($friend->pic_profile_path) }}" alt="User Image" class="friend-image">
            @else
            <img src="{{ asset('default-user.png') }}" alt="User Image" class="friend-image">
            @endif
        </div>
        <div class="friend-text">
            <p><a href="{{ action('UserController@showFriend', ['email' => $friend->email]) }}">{{ $friend->name }} {{$friend->lastname}}</a></p>
            <p>{{ $friend->email }}</p>
            <p><a href="{{ action('MessageController@show', ['friend_email' => $friend->email]) }}">Send Message</a></p>
            <p><a href="{{ action('FriendsController@deleteFriend', ['friend' => $friend->email]) }}">Delete Friend</a></p>
        </div>
        
    </div> 
        
@endforeach

@if (count($friends) != 0)
<span class="link-pagination">
    {{ $friends->links() }}
</span>
@endif