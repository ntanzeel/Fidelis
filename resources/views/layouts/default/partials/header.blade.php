<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('pages.index') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @foreach($navigation as $nav)
                <ul class="nav navbar-nav {{ 'navbar-' . $nav->type }}">
                    @foreach($nav->links as $link)
                        @if($link->dropdown)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ $link->title }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @foreach($link->dropdown as $dropdown)
                                        <li class="{{ $dropdown->active ? 'active' : '' }}">
                                            <a href="{{ route($dropdown->route->name, $dropdown->route->params) }}">{{ $dropdown->title }}</a>
                                        </li>
                                        @if($dropdown->divider)
                                            <li role="separator" class="divider"></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="{{ $link->active ? 'active' : '' }}">
                                <a href="{{ route($link->route->name, $link->route->params) }}">{{ $link->title }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</nav>