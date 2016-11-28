<div id="comment-{{ $comment->id }}" class="comment">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar author-photo" src="{{ $comment->user->photo }}"
                 alt="{{ $comment->user->name }} Profile Photo">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading comment-header info">
            <a class="author" href="{{ route('profile.view', [$comment->user->username]) }}">
                <strong class="full-name author-name">{{ $comment->user->name }}</strong>
                <span class="username author-username">&commat;{{ $comment->user->username }}</span>
            </a>
            <span class="time small color light">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="comment-body">
            {!! $comment->htmlText() !!}
        </div>
        <div class="comment-footer">
            @include('posts.partials.actions', ['showComments' => false, 'comment' => $comment])
        </div>
    </div>
</div>