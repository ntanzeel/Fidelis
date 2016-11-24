@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $category }}
                    @if(Auth::user() && !$isRoot)
                        <a role="button" id='{{ $tag->id }}' class="btn btn-default pull-right" href="#">
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
                        @include('components.post.feed', compact('posts'))
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
        </div>
    </div>
    <script>
        var subscribeUrl = "{{ route('api.subscriptions.store') }}";
        var unsubscribeUrl = "{{ route('api.subscriptions.delete',[$tag]) }}";
    </script>
@stop