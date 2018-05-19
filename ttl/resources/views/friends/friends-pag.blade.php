
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
            <!-- The conditinal it will check if session('user')->pic_profile_path exists -->
            @if (File::exists(session('user')->pic_profile_path))
            <img src="{{ asset($friend->pic_profile_path) }}" alt="User Image" class="friend-image">
            @else
            <img src="{{ asset('default-user.png') }}" alt="User Image" class="friend-image">
            @endif
        </div>
        <div class="friend-text">
            <p><a href="{{ action('UserController@showFriend', ['email' => $friend->email]) }}">{{ $friend->name }} {{$friend->lastname}}</a></p>
            <p>{{ $friend->email }}</p>
            <p><a href="{{ action('MessageController@show', ['friend_email' => $friend->email]) }}">Send Message</a></p>
            <a href="#" data-title="Delete Friend" style="color: red" data-toggle="modal" data-target="#removeFriendModal">Delete Friend</a>

        </div>
        
    </div> 
        


<div class="modal fade" id="removeFriendModal" tabindex="-1" role="dialog" aria-labelledby="removeFriendModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('FriendsController@deleteF',['friendEmail' => $friend->email ]) }}">
            {{ csrf_field() }}

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="removeFriendModalLabel">Remove Friend</h4>
            </div>
            <div class="modal-body write-pub">
            Are you sure you want to delete {{ $friend->name }} from your friends?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <span class="pull-right">
                <button type="submit" class="btn btn-primary">Delete</button>
            </span>
            </div>
        </form>
        </div>
    </div>
</div>

@endforeach

@if (count($friends) != 0)
<span class="link-pagination">
    {{ $friends->links() }}
</span>
@endif