@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @yield('banner')
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('discover.partials.sidebar', ['categories' => $categories, 'active' => $category])
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-default content-panel">
                    <div class="panel-body padding-0">
                        @include('posts.partials.feed', compact('posts'))
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @if(Auth::user())
                    @include('discover.partials.personalised', ['active' => $category])
                @endif
                @widget('trending')
            </div>
        </div>
    </div>
@stop