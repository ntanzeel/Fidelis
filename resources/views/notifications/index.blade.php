@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">@widget('users')</div>
        <div class="col-md-6 col-sm-12 ">
            <div class="panel panel-default">
                <!--WHY DOES ADDING PADDING 0 CHANGE THE LOOK-->
                <div class="panel-body" style="padding: 0">
                    <ul class="media-list notification-list">
                        @foreach($notifications as $notification)
                            <li class="media">
                                @include('notifications.partials.notification', compact('notification'))
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 hidden-sm hidden-xs">
                @widget('trending')
            </div>
    </div>
@endsection
