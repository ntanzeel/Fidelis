@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $category }}
                    @if(Auth::user() && !$isRoot && $category != 'Recommendations')
                        <a role="button" class="btn btn-default pull-right btn-subscribe-toggle" href="#"
                           data-api="{{ url('/api/subscription/')  }}"
                           data-id="{{ $tag->id }}" data-status="{{ $subscribed ? 1 : 0 }}">
                            {{ $subscribed ? 'Unsubscribe' : 'Subscribe' }}
                        </a>
                    @endif
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
                <div class="panel panel-default">
                    <div class="panel-body padding-0">
                        @include('posts.partials.feed', compact('posts'))
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
        </div>
    </div>
@stop