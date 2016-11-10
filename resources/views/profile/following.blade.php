@extends('profile.layout', ['user' => $user, 'active' => 'following'])


@section('content')
    <div class="row">
        @foreach($user->following as $following)
            <div class="col-md-4">
                @include('profile.partials.user', ['user' => $following])
            </div>
        @endforeach
    </div>
@stop