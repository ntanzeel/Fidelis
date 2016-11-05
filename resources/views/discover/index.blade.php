@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="col-md-3">
        @include('discover.partials.sidebar', ['categories' => $categories, 'active' => false])
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                asa
            </div>
        </div>
    </div>
@stop