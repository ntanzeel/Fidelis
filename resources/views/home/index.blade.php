@extends(config('view.layout', 'layouts.default') . '.app')
@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default content-panel">
                <div class="panel-heading">
                    @include('posts.partials.create')
                </div>
                <div class="panel-body padding-0">
                    @include('posts.partials.feed', compact('posts'))
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
