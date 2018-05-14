<div id="general-main-menu">

    <!-- URL:to() is a temporal way to redirect. -->

    <a href="{{ action('UserController@show') }}" class="general-main-menu-option">
        <p>Profile</p>
    </a>
    <a href="{{ action('FriendsController@show') }}" class="general-main-menu-option">
        <p>Friends</p>
    </a>
    <a href="{{ action('MessageController@show') }}" class="general-main-menu-option">
        <p>Messages</p>
    </a>
    <a href="{{ action('SongController@show') }}" class="general-main-menu-option">
        <p>Songs</p>
    </a>
    <a href="{{ action('GroupController@show') }}" class="general-main-menu-option">
        <p>Groups</p>
    </a>
    <a href="{{ action('UserController@showSettings') }}" class="general-main-menu-option">
        <p>Settings</p>
    </a>
</div>