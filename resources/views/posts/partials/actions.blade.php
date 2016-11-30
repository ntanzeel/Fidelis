<ul class="list-inline list-unstyled action-list">
    <li class="{{ Auth::guest() || $comment->user_id == Auth::user()->id ? 'disabled' : '' }}">
        @php($liked = Auth::user() && $comment->votes->count() && $comment->votes->first()->type == 'up')
        <a href="{{ route('api.vote.store', [$comment->id]) }}"
           data-type="up" role="button"
           class="action action-vote action-like {{ $liked ? 'active' : '' }}">
            <i class="fa fa-thumbs-up"></i> <span
                    class="text">{{ $comment->up_votes }}</span>
        </a>
    </li>
    <li class="{{ Auth::guest() || $comment->user_id == Auth::user()->id ? 'disabled' : '' }}">
        @php($disliked = Auth::user() && $comment->votes->count() && $comment->votes->first()->type == 'down')
        <a href="{{ route('api.vote.store', [$comment->id]) }}"
           data-type="down" role="button"
           class="action action-vote action-dislike {{ $disliked ? 'active' : '' }}">
            <i class="fa fa-thumbs-down"></i> <span
                    class="text">{{ $comment->down_votes }}</span>
        </a>
    </li>
    @if (!empty($showComments))
        <li>
            <a role="button" class="action action-comment"
               href="{{ route('post.view', [$post->user->username, $post->id]) }}">
                <i class="fa fa-comment"></i> {{ $post->comments()->count() }}
            </a>
        </li>
    @endif
    <li class="pull-right">
        <a role="button" class="action action-flag">
            <i class="fa fa-flag"></i>
        </a>
    </li>
</ul>