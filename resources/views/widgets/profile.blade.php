@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/widgets/profile.css') }}" rel="stylesheet">
@endpush

<div class="panel panel-default widget profile-widget">
    <a class="profile-cover" href="{{ route('profile.view', [$user->username]) }}" style="background-image: url({{ $user->cover }})"></a>
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
        <div class="profile-statistics">
            <ul class="list-unstyled statistics-list">
                <li>
                    <a href="{{ route('profile.view', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Posts</span>
                        <span class="stat-value" id="posts-value">{{ $user->posts()->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.followers', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Followers</span>
                        <span class="stat-value">{{ $user->followers()->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.following', [$user->username]) }}" class="stat-link">
                        <span class="stat-label">Following</span>
                        <span class="stat-value" id="following-value">{{ $user->following()->count() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>