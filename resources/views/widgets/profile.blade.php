<div class="panel panel-default widget profile-widget">
    <a class="profile-cover" href="{{ route('profile.index') }}" style="background-image: url({{ asset('storage/' . Auth::user()->cover) }})"></a>
    <div class="panel-body widget-body">
        <a href="{{ route('profile.index') }}" class="profile-photo">
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" />
        </a>
        <div class="profile-about">
            <a class="profile-name" href="{{ route('profile.index') }}">
                {{ Auth::user()->name }}
            </a>
            <a class="profile-username" href="{{ route('profile.index') }}">
                &commat;{{ Auth::user()->username }}
            </a>
        </div>
        <div class="profile-statistics">
            <ul class="list-unstyled statistics-list">
                <li>
                    <a href="{{ route('profile.index') }}" class="stat-link">
                        <span class="stat-label">Posts</span>
                        <span class="stat-value">{{ 99 }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.followers', [Auth::user()->username]) }}" class="stat-link">
                        <span class="stat-label">Followers</span>
                        <span class="stat-value">{{ Auth::user()->followers()->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.following', [Auth::user()->username]) }}" class="stat-link">
                        <span class="stat-label">Following</span>
                        <span class="stat-value">{{ Auth::user()->following()->count() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>