<div id="post-{{ $post->id }}" class="post">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar author-photo" src="{{ $post->user->photo }}"
                 alt="{{ $post->user->name }} Profile Photo">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading post-header info">
            <a class="author" href="{{ route('profile.view', [$post->user->username]) }}">
                <strong class="full-name author-name">{{ $post->user->name }}</strong>
                <span class="username author-username">&commat;{{ $post->user->username }}</span>
            </a>
            <span class="time small color light">{{ $post->created_at->diffForHumans() }}</span>
        </div>
        <div class="post-body">
            <div class="post-images">
                @foreach($post->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" class="img-responsive img-thumbnail"
                         width="45%" />
                @endforeach
            </div>
            {!! $post->content->htmlText() !!}
        </div>
        <div class="post-footer">
            <ul class="list-inline list-unstyled action-list">
                <li>
                    @php($liked = Auth::user() && $post->content->votes->count() && $post->content->votes->first()->type == 'up')
                    <a href="{{ route('api.vote.store', [$post->content->id]) }}"
                       data-type="up" role="button"
                       class="action action-vote action-like {{ $liked ? 'active' : '' }}">
                        <i class="fa fa-thumbs-up"></i> <span class="text">{{ $post->content->up_votes }}</span>
                    </a>
                </li>
                <li>
                    @php($disliked = Auth::user() && $post->content->votes->count() && $post->content->votes->first()->type == 'down')
                    <a href="{{ route('api.vote.store', [$post->content->id]) }}"
                       data-type="down" role="button"
                       class="action action-vote action-dislike {{ $disliked ? 'active' : '' }}">
                        <i class="fa fa-thumbs-down"></i> <span class="text">{{ $post->content->down_votes }}</span>
                    </a>
                </li>
                <li>
                    <a role="button" class="action action-comment"
                       href="{{ route('post.view', [$post->user->username, $post->id]) }}">
                        <i class="fa fa-comment"></i> {{ $post->comments()->count() }}
                    </a>
                </li>
                <li class="pull-right">
                    <a role="button" class="action action-flag">
                        <i class="fa fa-flag"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>