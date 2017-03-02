@php($abusive = Auth::user() && ($comment->reports->count() || Auth::user()->settings['abuse_rating']->value < $comment->abuse_score))
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
            <div id="comment-{{ $comment->id }}-content" class="collapse {{ $abusive ? 'margin-b-15' : 'in' }}"
                    {!! $abusive ? 'aria-expanded="false"' : 'aria-expanded="true"' !!}>
                {!! $comment->htmlText() !!}
            </div>
            @if ($abusive)
                <div class="text-warning" id="comment-{{ $comment->id }}-content-toggle">
                    This post has been hidden as it was considered abusive for you.
                    <a class="text-danger" role="button" data-toggle="collapse" href="#comment-{{ $comment->id }}-content"
                       aria-expanded="false" aria-controls="comment-{{ $comment->id }}-content">
                        Toggle View
                    </a>
                </div>
            @endif
        </div>
        <div class="comment-footer">
            @include('posts.partials.actions', ['showComments' => false, 'comment' => $comment])
        </div>
    </div>
</div>