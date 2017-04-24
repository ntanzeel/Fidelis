@extends('profile.layout', ['user' => $user, 'active' => 'rated', 'isFollowing' => $isFollowing])

@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="panel panel-default content-panel">
                <div class="panel-body padding-0">
                    @include('posts.partials.feed', compact('posts'))
                </div>
            </div>
        </div>
        <div class="col-md-4 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@stop