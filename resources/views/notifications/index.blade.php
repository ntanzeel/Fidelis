@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="media-list post-list">
                        @foreach($notifications as $notif)
                            <li class="media">
                                @include('notifications.partials.notification', compact('notif'))
                            </li>
                        @endforeach
                    </ul>

                {{--@foreach($notifications as $notif)--}}
                    {{--<div data-toggle="modal" data-target="#notifModal">--}}
                        {{--<div>--}}
                            {{--{{$notif->notification}} <small>{{$notif->from->name}}</small>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<hr>--}}

                    {{--<!-- Modal -->--}}
                    {{--<div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
                        {{--<div class="modal-dialog" role="document">--}}
                            {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                    {{--<h4 class="modal-title" id="myModalLabel">{{$notif->comment->content}} <small> {{$notif->to->name}}</small></h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body">--}}
                                    {{--{{$notif->notification}} <small>{{$notif->from->name}}</small>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                    {{--<form class="ajax" method="post" action="">--}}
                                        {{--{{ csrf_field() }}--}}

                                        {{--<div class="form-group">--}}
                                            {{--<label class="sr-only" for="text">Email address</label>--}}
                                            {{--<textarea class="form-control" id="text" name="text" placeholder="What do you have to say to this?"></textarea>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-right">--}}
                                            {{--<button type="submit" class="btn btn-default">Reply</button>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--{{$notif}}--}}
                {{--@endforeach--}}
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
