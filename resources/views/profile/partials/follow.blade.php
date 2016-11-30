@php($isFollowing = (!empty($dropdown) && !empty($isFollowing)) || empty($dropdown) && $user->followers->count())

@if (Auth::user() && $user->id != Auth::user()->id)
    <div class="btn-group {{ empty($dropdown) ? 'btn-group-justified' : '' }}">
        @if ($isFollowing)
            <a href="#" role="button" class="btn btn-danger btn-follow-toggle"
               data-api="{{ route('api.follower.store')  }}"
               data-id="{{ $user->id }}"
               data-status="1">Unfollow</a>
        @else
            <a href="#" role="button" class="btn btn-primary btn-follow-toggle"
               data-api="{{ route('api.follower.store')  }}"
               data-id="{{ $user->id }}"
               data-status="0">Follow
            </a>
        @endif

        @if (!empty($dropdown))
            <button type="button"
                    class="btn {{ $isFollowing ? 'btn-danger' : 'btn-primary' }} dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" role="button" class="btn-toggle-block"
                       data-api="{{ route('api.blocked.store')  }}"
                       data-id="{{ $user->id }}"
                       data-status="{{ Auth::user()->blocked->count() }}">{{ Auth::user()->blocked->count() ? 'Unblock' : 'Block' }}</a>
                </li>
            </ul>
        @endif
    </div>
@elseif(Auth::user() && $user->id == Auth::user()->id)
    <button class="btn btn-block btn-info">It&apos;s You!</button>
@else
    <a href="{{ route('auth.login') }}" class="btn btn-block btn-primary">
        Login or Register
    </a>
@endif