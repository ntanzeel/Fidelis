<div class="post-comments">
    <div class="media mt-2">
        <a class="media-left" href="#">
            <img class="media-object avatar" src="{{ $comment->user->photo }}"
                 alt="Generic placeholder image">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->name }}</h4>
            {!! $comment->htmlText() !!}
            @include('posts.partials.footer', compact('post'))
        </div>
    </div>
</div>
<hr>