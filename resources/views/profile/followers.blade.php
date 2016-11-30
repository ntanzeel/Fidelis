@extends('profile.layout', ['user' => $user, 'active' => 'followers', 'isFollowing' => $isFollowing])


@section('content')
    <div class="row">
        @foreach($user->followers as $follower)
            <div class="col-md-4">
                @include('profile.partials.user', ['user' => $follower])
            </div>
        @endforeach
    </div>
@stop