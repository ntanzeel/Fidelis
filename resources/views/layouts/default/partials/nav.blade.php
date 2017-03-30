@foreach($nav->links as $link)
    @if($link->dropdown)
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-tooltip="true" data-placement="bottom" title="{{ $link->title }}"
               data-toggle="dropdown" role="button"
               aria-expanded="false">
                <span class="visible-xs-inline">{{ $link->title }}</span> <span class="caret"></span>
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
            <a href="{{ route($link->route->name, $link->route->params) }}" data-tooltip="true" data-placement="bottom"
               title="{{ $link->title }}">
                @if(isset($link->icon))
                    <i class="fa fa-{{ $link->icon }}" aria-hidden="true"></i>
                @endif
                <span class="visible-xs-inline">{{ $link->title }}</span>
                @if($link->title == 'Notifications')
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="badge">{{ Auth::user()->unreadNotifications->count() }}</span>
                    @endif
                @endif
            </a>
        </li>
    @endif
@endforeach