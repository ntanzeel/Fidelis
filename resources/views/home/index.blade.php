@extends(config('view.layout', 'layouts.default') . '.app')

@push('stylesheets')
    <link href="{{ asset('assets/css/layouts/default/widgets/profile.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form method="post" action="">
                        <div class="form-group">
                            <label class="sr-only" for="text">Email address</label>
                            <textarea class="form-control" id="text" placeholder="What are you thinking?"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="panel-body text-center">
                    Well, it seems your timeline is pretty boring...
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
