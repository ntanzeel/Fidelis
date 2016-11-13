<div id="post-{{ $post->id }}" class="post">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar author-photo-photo" src="{{ $post->user->photo }}" alt="{{ $post->user->name }} Profile Photo">
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
            {!! $post->content->htmlText() !!}
        </div>
        <div class="post-footer">
            <ul class="list-inline list-unstyled action-list">
                <li>
                    <a role="button" class="action action-like"><i class="fa fa-heart"></i> {{ $post->content->reputation }}</a>
                </li>
                <li>
                    <a role="button" class="action action-comment"><i class="fa fa-comment"></i> {{ $post->content->reputation }}</a>
                </li>
                <li class="pull-right">
                    <a role="button" class="action action-flag"><i class="fa fa-flag"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>