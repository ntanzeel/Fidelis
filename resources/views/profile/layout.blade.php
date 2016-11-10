@extends(config('view.layout', 'layouts.default') . '.app')

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/widgets/profile.css') }}" rel="stylesheet">
@endpush

@section('container')
    <div class="profile-header">
        <div class="profile-cover" style="background-image: url({{ $user->cover }})"></div>
        <div class="profile-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="profile-photo-container">
                            <a class="profile-photo">
                                <img src="{{ $user->photo }}" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="{{ $active == 'posts' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.view', [$user->username]) }}">
                                    <span class="nav-label">Posts</span>
                                    <span class="nav-value">{{ 99 }}</span>
                                </a>
                            </li>
                            <li class="{{ $active == 'followers' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.followers', [$user->username]) }}" >
                                    <span class="nav-label">Followers</span>
                                    <span class="nav-value">{{ $user->followers()->count() }}</span>
                                </a>
                            </li>
                            <li class="{{ $active == 'following' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.following', [$user->username]) }}">
                                    <span class="nav-label">Following</span>
                                    <span class="nav-value">{{ $user->following()->count() }}</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#">
                                    <span class="nav-label">Likes</span>
                                    <span class="nav-value">{{ 99 }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div>
                        <strong>{{ $user->name }}</strong><br />
                        <span>&commat;{{ $user->username }}</span>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
