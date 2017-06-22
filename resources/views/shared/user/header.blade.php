<header class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">Site Title</li>
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
        <li><img src="https://placehold.it/100x100" width=40 height=40 class="c-profile-image"></li>
        @if( empty($authUser) )
        <li><a href="{{ action('User\AuthController@getSignIn') }}">Sign In</a></li>
        <li><a href="{{ action('User\AuthController@getSignUp') }}">Sign Up</a></li>
        @else
        <li><a href="{{ action('User\AuthController@getSignIn') }}">Setting</a></li>
        <li><a href="{{ action('User\AuthController@getSignUp') }}">Sign Out</a></li>
        @endif
        </ul>
    </div>
</header>
