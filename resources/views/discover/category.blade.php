@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="col-md-3">
        @include('discover.partials.sidebar', ['categories' => $categories, 'active' => $category])
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="page-title">
                    {{ $active }}
                </div>
                Post
            </div>
        </div>
    </div>
@stop