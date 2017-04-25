<div class="notification {{ !$notification->isFollow() && !$notification->isPendingFollow()  ? 'show-post' : '' }}" id="notification">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar" src="{{ $notification->from()->photo }}" alt="Generic placeholder image">
        </a>
    </div>
    <div class="media-body">
        <p>{!! $notification->getHtmlText() !!} </p>

        @if(!$notification->isFollow() && !$notification->isPendingFollow())
            <p>{!!   $notification->regarding()->htmlText() !!}</p>
        @else
        @endif
        <div class="notification-footer">
            <ul class="list-inline list-unstyled action-list">
                @if(!$notification->isFollow() && !$notification->isPendingFollow())
                    @include('posts.partials.actions', ['post' => $notification->regarding()->post,'isPost' => true, 'comment' => $notification->regarding()])
                @endif
            </ul>
        </div>
    </div>
</div>
