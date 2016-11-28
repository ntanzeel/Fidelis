@extends('profile.layout', ['user' => $user, 'active' => 'posts'])


@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body padding-0">
                    @include('posts.partials.feed', compact('posts'))
                </div>
            </div>
        </div>
        <div class="col-md-4 hidden-sm hidden-xs">
            @widget('users')
            @widget('trending')
        </div>
    </div>
@stop