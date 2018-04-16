<div id="general-main-menu">

    <!-- URL:to() is a temporal way to redirect. -->

    <a href="{{ URL::to('/profile') }}" class="general-main-menu-option">
        <p>Profile</p>
    </a>
    <a href="{{ URL::to('/friends') }}" class="general-main-menu-option">
        <p>Friends</p>
    </a>
    <a href="{{ URL::to('/messages') }}" class="general-main-menu-option">
        <p>Messages</p>
    </a>
    <a href="{{ URL::to('/songs') }}" class="general-main-menu-option">
        <p>Songs</p>
    </a>
    <a href="{{ URL::to('/groups') }}" class="general-main-menu-option">
        <p>Groups</p>
    </a>
    <a href="{{ URL::to('/settings') }}" class="general-main-menu-option">
        <p>Settings</p>
    </a>
</div>