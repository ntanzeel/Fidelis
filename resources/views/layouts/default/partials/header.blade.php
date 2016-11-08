<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{--<!-- Branding Image -->--}}
            {{--<a class="navbar-brand" href="{{ route('pages.index') }}">--}}
            {{--{{ config('app.name') }}--}}
            {{--</a>--}}
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                @include('layouts.default.partials.nav', ['nav' => $navigation->app])
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @include('layouts.default.partials.nav', ['nav' => $navigation->user])

                @if (Auth::user())
                    <li class="dropdown profile-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <span class="sr-only">{{ Auth::user()->name }}</span>
                            <img src="https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-10-3-128.png"
                                 width="38px" height="38px" />
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('auth.logout') }}">Log out</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>