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
            @include('posts.partials.actions', ['showComments' => true, 'comment' => $post->content, 'post' => $post])
        </div>
    </div>
</div>