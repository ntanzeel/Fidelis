@if (Auth::user() && $user->id != Auth::user()->id)
    @if ($user->followers->count())
        <a class="btn btn-block btn-danger btn-follow-toggle"
           data-api="{{ route('api.follower.store')  }}"
           data-id="{{ $user->id }}"
           data-status="1">Unfollow</a>
    @else
        <button class="btn btn-block btn-primary btn-follow-toggle"
                data-api="{{ route('api.follower.store')  }}"
                data-id="{{ $user->id }}"
                data-status="0">Follow
        </button>
    @endif
@elseif(Auth::user() && $user->id == Auth::user()->id)
    <button class="btn btn-block btn-info">It&apos;s You!</button>
@else
    <a href="{{ route('auth.login') }}" class="btn btn-block btn-primary">
        Login or Register
    </a>
@endif