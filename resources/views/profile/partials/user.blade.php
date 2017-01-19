<div class="panel panel-default widget profile-widget">
    <a class="profile-cover" href="{{ route('profile.view', [$user->username]) }}"
       style="background-image: url({{ $user->cover }})"></a>
    <div class="panel-body widget-body">
        <a href="{{ route('profile.view', [$user->username]) }}" class="profile-photo">
            <img src="{{ $user->photo }}" />
        </a>
        <div class="profile-about">
            <a class="profile-name" href="{{ route('profile.view', [$user->username]) }}">
                {{ $user->name }}
            </a>
            <a class="profile-username" href="{{ route('profile.view', [$user->username]) }}">
                &commat;{{ $user->username }}
            </a>
        </div>
        <div class="profile-status margin-b-15">
            @include('profile.partials.follow', compact('user'))
        </div>
        <div class="profile-statistics">
            <ul class="list-unstyled statistics-list">
                <li>
                    <a href="{{ route('profile.view', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Posts</span>
                        <span class="stat-value">{{ $user->posts()->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.following', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Followers</span>
                        <span class="stat-value">{{ $user->followers()->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.following', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Following</span>
                        <span class="stat-value">{{ $user->following()->count() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>