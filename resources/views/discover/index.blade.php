@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="col-md-3">
        @include('discover.partials.sidebar', ['categories' => $categories, 'active' => "Subscribed"])
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="page-title">
                    Subscribed
                </div>
                Post
            </div>
        </div>
    </div>
@stop