<div id="notification-{{ $notif->id }}" class="post">
    <div class="media-left">
        <a href="#">
            <img class="media-object profile-photo" src="{{ $notif->from->photo }}" alt="{{ $notif->from->name }} Profile Photo">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            {{--<a href="{{ route('profile.view', [$post->user->username]) }}">{{ $post->user->name }}</a>--}}
            <a href="#">{{ $notif->from->name }}</a>
        </h4>
        <div class="post-content">
            {{ $notif->notification }}
        </div>
    </div>
</div>