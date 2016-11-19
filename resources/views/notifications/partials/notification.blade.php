<div class="notification">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar" src="{{ $notification->from()->photo }}" alt="Generic placeholder image">
        </a>
    </div>
    <div class="media-body">
        <p>{!! $notification->getHtmlText() !!} </p>

        @if($notification->type != \App\Notifications\Follow::class)
            <p>{!!   $notification->regarding()->htmlText() !!}</p>
        @endif
        <div class="notification-footer">
            <ul class="list-inline list-unstyled action-list">
                <li>
                    <a role="button" class="action action-like"><i class="fa fa-thumbs-up"></i></a>
                </li>
                <li>
                    <a role="button" class="action action-like"><i class="fa fa-thumbs-down"></i></a>
                </li>
                <li>
                    {{ date('H:i F-y', $notification->created_at->getTimestamp()) }}
                </li>
            </ul>
        </div>
    </div>
</div>