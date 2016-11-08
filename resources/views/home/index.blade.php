@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @include('home.partials.profile')
            @include('home.partials.users')
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
            @include('home.partials.trends')
        </div>
    </div>
@endsection
