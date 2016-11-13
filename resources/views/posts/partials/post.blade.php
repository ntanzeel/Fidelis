<div id="post-{{ $post->id }}" class="post">
    <div class="media-left">
        <a href="#">
            <img class="media-object profile-photo" src="{{ $post->user->photo }}" alt="{{ $post->user->name }} Profile Photo">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            <a href="{{ route('profile.view', [$post->user->username]) }}">{{ $post->user->name }}</a>
        </h4>
        <div class="post-content">
            {!! $post->content->htmlText() !!}
        </div>
    </div>
</div>