<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Time To Listen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">

                @if (Auth::user() != null)
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('UserController@show') }}">Profile</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('FriendsController@show') }}">Friends</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('MessageController@show') }}">Messages</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('SongController@show') }}">Songs</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('GroupController@show') }}">Groups</a>
                    </li>
                    @if (Auth::user()->type == 1)
                        <li class="nav-item px-lg-3">
                            <a class="nav-link text-uppercase text-expanded" href="{{ action('UserController@showAdminLinks') }}">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="/information">About</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('UserController@showSettings') }}">Settings</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('UserController@logout') }}">Logout</a>
                    </li>
                @elseif (Auth::user() == null)
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="{{ action('UserController@show') }}">Log In</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="/signup">Sign Up</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link text-uppercase text-expanded" href="/information">About</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
