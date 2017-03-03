@extends(config('view.layout', 'layouts.default') . '.app')

@section('content')
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('profile')
            @widget('users')
        </div>
        <div class="col-md-6 col-sm-12 ">
            <div class="panel panel-default content-panel">
                <div class="panel-body padding-0">
                    <div class="post">
                        <div class="post-header">
                            <div href="#" class="author-photo">
                                <a href="#">
                                    <img class="media-object avatar author-photo" src="{{ $user->photo }}"
                                         alt="{{ $user->name }} Profile Photo">
                                </a>
                            </div>
                            <div class="author-info">
                                <div class="author-name">
                                    <a href="{{ route('profile.view', [$user->username]) }}">
                                        <strong class="full-name author-name">{{ $user->name }}</strong>
                                    </a>
                                </div>
                                <div class="author-username">
                                    <a href="{{ route('profile.view', [$user->username]) }}">
                                        <span class="username author-username">&commat;{{ $post->user->username }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-images">
                                @foreach($post->images as $image)
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                         class="img-responsive img-thumbnail" width="45%" />
                                @endforeach
                            </div>
                            <div class="post-text">
                                {!! $post->content->htmlText() !!}
                            </div>
                        </div>
                        <div class="post-footer">
                            @include('posts.partials.actions', ['isPost' => true, 'comment' => $post->content])
                        </div>
                    </div>
                    <div class="post-comments">
                        <ul class="media-list comment-list">
                            @forelse($post->comments as $comment)
                                <li class="media">
                                    @include('posts.partials.comment', compact('comment'))
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <div class="add-comment padding-15">
                        @include('posts.partials.reply')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-sm hidden-xs">
            @widget('trending')
        </div>
    </div>
@endsection