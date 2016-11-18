@foreach($nav->links as $link)
    @if($link->dropdown)
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">
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
            <a href="{{ route($link->route->name, $link->route->params) }}">
                @if(isset($link->icon))
                    <i class="fa fa-{{ $link->icon }}" aria-hidden="true"></i>
                @endif
                {{ $link->title }}
                @if($link->title == 'Notifications')
                    <span class="badge">{{ count(Auth::user()->unreadNotifications) }}</span>
                @endif
            </a>
        </li>
    @endif
@endforeach