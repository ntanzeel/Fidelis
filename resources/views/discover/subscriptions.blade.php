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
                        @foreach($subscriptions as $subscription)
                            <li class='list-subscription'>
                                {{ $subscription }} <a class='btn-unsubscribe' href="#">Unsubscribe</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
        </div>
    </div>
@stop