@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">@widget('trending')</div>
        <div class="col-md-6 col-sm-12 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="media-list">
                        @foreach($notifications as $notification)
                            <li class="media">
                                @include('notifications.partials.notification', compact('notification'))
                            </li>
                        @endforeach
                        {{ Auth::user()->unreadNotifications->markAsRead() }}
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
    </div>
@endsection
