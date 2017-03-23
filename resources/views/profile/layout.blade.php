@extends(config('view.layout', 'layouts.default') . '.app')

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/widgets/profile.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/layouts/default/posts/partials/image-modal.js') }}"></script>
@endpush

@section('container')
    <div class="profile-header">
        <div class="profile-cover" style="background-image: url({{ $user->cover }})">
            @if(Auth::user() && Auth::user()->username == $user->username)
                <a class="btn-cover-upload" data-toggle="tooltip" title="Upload new cover picture" href="#"><i
                            class="fa fa-upload"></i></a>
            @endif
        </div>
        <div class="profile-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="anchor profile-photo-container">
                            <a class="profile-photo">
                                <img src="{{ $user->photo }}" class="exp anchor" style="cursor:pointer"/>
                            </a>
                            @if(Auth::user() && Auth::user()->username == $user->username)
                                <a class="btn-upload" data-toggle="tooltip" title="Upload new profile picture" href="#"><i
                                            class="fa fa-upload"></i></a>
                                <form id="submit-profile-pic" class="imgupload" enctype="multipart/form-data"
                                      method="post" action="{{ route('settings.account.upload_profile_pic') }}">
                                    <input type="file" id="profile-upload" name="pic" accept="image/*" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                                <form id="submit-cover" class="imgupload" enctype="multipart/form-data" method="post"
                                      action="{{ route('settings.account.upload_cover_pic') }}">
                                    <input type="file" id="cover-upload" name="pic" accept="image/*" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="{{ $active == 'posts' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.view', [$user->username]) }}">
                                    <span class="nav-label">Posts</span>
                                    <span class="nav-value">{{ $user->posts()->count() }}</span>
                                </a>
                            </li>
                            <li class="{{ $active == 'followers' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.followers', [$user->username]) }}">
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
                            <li class="{{ $active == 'rated' ? 'active' : '' }}" role="presentation">
                                <a href="{{ route('profile.rated', [$user->username]) }}">
                                    <span class="nav-label">Rated</span>
                                    <span class="nav-value" id="rates-value">{{ $user->voted()->count() }}</span>
                                </a>
                            </li>
                            <li class="pull-right" role="presentation">
                                <div class="profile-actions">
                                    @include('profile.partials.follow', ['user' => $user, 'dropdown' => TRUE, 'isFollowing' => $isFollowing])
                                </div>
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
                    <div class="profile-info">
                        <p class="full-name">
                            <strong>{{ $user->name }}</strong>
                        </p>
                        <p class="username">
                            <span>&commat;{{ $user->username }}</span>
                        </p>
                        <p class="about">
                            {{ $user->about }}
                        </p>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Photos
                        </div>
                        <div class="panel-body anchor">
                            @foreach($images as $image)
                                <img id="img-{{ $image->id }}" src="{{ asset('storage/'.$image->path) }}"
                                     class="exp user-image img-responsive img-thumbnail" max-height="22px" max-width="22px">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('posts.partials.image-modal')
@endsection
