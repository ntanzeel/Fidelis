@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $category }}
                    @if(Auth::user())
                        <a role="button" id='{{ $tag }}' class="btn btn-default btn-subscribe pull-right" href="#">
                            @if($subscribed)
                                Unsubscribe
                            @else
                                Subscribe
                            @endif
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
                    <div class="panel-body">
                        Post
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
        </div>
    </div>
    <script>
        var token = "{{ csrf_token() }}";
        var subscribeUrl = "{{ route('subscriptions.subscribe') }}";
        var unsubscribeUrl = "{{ route('subscriptions.unsubscribe') }}";
    </script>
@stop