@extends(config('view.layout', 'layouts.default') . '.app')

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/widgets/profile.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @include('components.post.create')
                </div>
                <div class="panel-body" style="padding: 0">
                    @include('components.post.feed', compact('posts'))
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
