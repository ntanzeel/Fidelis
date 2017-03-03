@extends('settings.layout', ['title' => 'Blocked Accounts'])

@section('content')
    <ul class="blocked-list list-unstyled">
        @forelse($users as $user)
            <li class="row blocked-user">
                <div class="col-md-8 col-sm-12">
                    <div href="#" class="user-photo">
                        <a href="#">
                            <img class="media-object avatar user-photo" src="{{ $user->photo }}"
                                 alt="{{ $user->name }} Profile Photo">
                        </a>
                    </div>
                    <div class="user-info">
                        <div class="user-name">
                            <a href="{{ route('profile.view', [$user->username]) }}">
                                <strong class="full-name user-name">{{ $user->name }}</strong>
                            </a>
                        </div>
                        <div class="user-username">
                            <a href="{{ route('profile.view', [$user->username]) }}">
                                <span class="username user-username">&commat;{{ $user->username }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 text-right">
                    <a href="#" class="btn btn-primary btn-unblock btn-toggle-block"
                       data-api="{{ route('api.blocked.store')  }}"
                       data-id="{{ $user->id }}"
                       data-status="1">Unblock</a>
                </div>
            </li>
        @empty
            <li class="text-center">
                No Users.
            </li>
        @endforelse
    </ul>
@stop