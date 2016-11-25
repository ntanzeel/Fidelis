@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object avatar" src="{{ $user->photo }}" alt="Generic placeholder image">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $user->name }}</h4>
                            {!! $post->content->htmlText() !!}
                            {{--@forelse($comment as $comment)--}}
                                <div class="media mt-2">
                                    <a class="media-left" href="#">
                                        <img class="media-object" src="..." alt="Generic placeholder image">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Nested media heading</h4>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </div>
                            {{--@empty--}}

                            {{--@endforelse--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
