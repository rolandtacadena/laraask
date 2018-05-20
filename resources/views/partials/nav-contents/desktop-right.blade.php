<div class="top-bar-right">
    <ul class="dropdown menu" data-dropdown-menu>

        @if($isLoggedIn)

            <li class="has-submenu help-infos">
                <a href="{{ route('user-show', $authUser) }}">{{ $authUser->name }}</a>
                <ul class="menu submenu vertical" data-submenu>
                    <li><a href="{{ route('user-show', $authUser) }}">My Profile</a></li>
                    <li>
                        <form class="logout" action="{{ url('/logout') }}" method="POST">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>

        @else

            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>

        @endif

        <li class="has-submenu help-infos">
            <a href="#">Help</a>
            <ul class="menu submenu vertical" data-submenu>
                <li>
                    <a href="{{ route('how-it-works') }}">How it works
                        <span>Start here for a quick overview of the site</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}">About
                        <span>Start here for a quick overview of the site</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--<li>
            <form class="searchQA" action="">
                <input type="search" placeholder="Search QA">
            </form>
        </li> [RCT]-->
    </ul>
</div>