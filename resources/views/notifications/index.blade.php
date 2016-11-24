@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12 ">
            <div class="panel panel-default">
                <div class="panel-body padding-0">
                    <ul class="media-list notification-list margin-0">
                        @forelse($notifications as $notification)
                            <li class="media">
                                @include('notifications.partials.notification', compact('notification'))
                            </li>
                        @empty
                            <li class="padding-15 text-center">You don't have any notifications...</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
