<div class="post-view-footer">
    <ul class="list-inline list-unstyled action-list">
        <li>
            @php($liked = Auth::user() && $comment->votes->count() && $comment->votes->first()->type == 'up')
            <a href="{{ route('api.vote.store', [$post->content->id]) }}"
               data-type="up" role="button"
               class="action action-vote action-like {{ $liked ? 'active' : '' }}">
                <i class="fa fa-thumbs-up"></i> <span class="text">{{ $comment->up_votes }}</span>
            </a>
        </li>
        <li>
            @php($disliked = Auth::user() && $comment->votes->count() && $comment->votes->first()->type == 'down')
            <a href="{{ route('api.vote.store', [$comment->id]) }}"
               data-type="down" role="button"
               class="action action-vote action-dislike {{ $disliked ? 'active' : '' }}">
                <i class="fa fa-thumbs-down"></i> <span class="text">{{ $comment->down_votes }}</span>
            </a>
        </li>
        <li>
            {{ $post->created_at->diffForHumans() }}
        </li>
    </ul>
</div>