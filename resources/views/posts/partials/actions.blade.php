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
    @if (!empty($isPost))
        <li>
            <a role="button" class="action action-comment"
               href="{{ route('post.view', [$post->user->username, $post->id]) }}">
                <i class="fa fa-comment"></i> {{ $post->no_comments }}
            </a>
        </li>
    @endif
    @if (Auth::user() && Auth::user()->id == $comment->user_id)
        <li class="pull-right">
            <a href="{{ $isPost ? route('api.post.delete', [$post->id]) : route('api.comment.delete', [$comment->post->id, $comment->id]) }}"
               role="button" class="action action-delete" data-type="{{ empty($isPost) ? 'comment' : 'post' }}">
                <i class="fa fa-trash"></i>
            </a>
        </li>
    @endif
    @if (Auth::user() && Auth::user()->id != $comment->user_id)
        <li class="pull-right">
            @php($reported = Auth::user() && $comment->reports->count())
            <a href="{{ route('api.report.store', [$comment->id]) }}" role="button"
               class="action action-flag {{ $reported ? 'active' : '' }}">
                <i class="fa fa-flag"></i>
            </a>
        </li>
    @endif
</ul>