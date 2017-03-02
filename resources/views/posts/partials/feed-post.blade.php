@php($abusive = Auth::user() && ($post->content->reports->count() || Auth::user()->settings['abuse_rating']->value < $post->content->abuse_score))
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
            <div id="post-{{ $post->id }}-content" class="collapse {{ $abusive ? 'margin-b-15' : 'in' }}"
                    {!! $abusive ? 'aria-expanded="false"' : 'aria-expanded="true"' !!}>
                <div class="post-images">
                    @foreach($post->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="img-responsive img-thumbnail"
                             width="45%" />
                    @endforeach
                </div>
                <div class="post-text">
                    {!! $post->content->htmlText() !!}
                </div>
            </div>
            @if ($abusive)
                <div class="text-warning" id="post-{{ $post->id }}-content-toggle">
                    This post has been hidden as it was considered abusive for you.
                    <a class="text-danger" role="button" data-toggle="collapse" href="#post-{{ $post->id }}-content"
                       aria-expanded="false" aria-controls="post-{{ $post->id }}-content">
                        Toggle View
                    </a>
                </div>
            @endif
        </div>
        <div class="post-footer">
            @include('posts.partials.actions', ['showComments' => true, 'comment' => $post->content, 'post' => $post])
        </div>
    </div>
</div>