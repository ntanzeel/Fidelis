@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    My Subscriptions
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('discover.partials.sidebar', ['categories' => $categories, 'active' => ""])
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-subscription">
                            @foreach($subscriptions as $subscription)
                                <li class='item-subscription'>
                                    {{ $subscription->tag->text }} <a id='{{ $subscription->tag_id }}'
                                                                      class='btn-unsubscribe' href="#">Unsubscribe</a>
                                </li>
                            @endforeach
                        </ul>
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
        var unsubscribeUrl = "{{ route('subscriptions.unsubscribe') }}";
    </script>
@stop