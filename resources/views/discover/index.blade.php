@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="discover-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    Subscribed
                    @if(Auth::user())
                        <a role="button" class="btn btn-default btn-manage pull-right"
                           href={{ route('settings.subscriptions.index') }}>Manage</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('discover.partials.sidebar', ['categories' => $categories, 'active' => "Subscribed"])
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Auth::user())
                            Post
                        @else
                            Sign up and log in to subscribe to different topics
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
        </div>
    </div>
@stop