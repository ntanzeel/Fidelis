@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <hr>
                    @foreach($notifications as $notif)
                        <div class="well" data-toggle="modal" data-target="#notifModal">
                            <div>
                                {{$notif->from->name}} replied to your post
                            </div>

                            <div>
                            {{$notif->notification}}
                            </div>
                        </div>
                        <hr>

                        <!-- Modal -->
                        <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{$notif->to->name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{$notif->comment->content}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--{{$notif}}--}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection
