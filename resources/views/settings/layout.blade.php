@extends(config('view.layout', 'layouts.default') . '.app')

@section('container')
    <div class="settings-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $title }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('settings.partials.sidebar')
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop