@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="discover-header">
        {{ $category }}
    </div>
    <div class="subscribe">
        <a class="btn-subscribe" href="#">Subscribe</a>
    </div>
    <div class="col-md-3">
        @include('discover.partials.sidebar', ['categories' => $categories, 'active' => $category])
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                Post
            </div>
        </div>
    </div>
    <div class="col-md-3 hidden-sm hidden-xs">
        @widget('trending')
    </div>
@stop