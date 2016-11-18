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
            {{ date('F y', $notification->created_at->getTimestamp()) }}
        </div>
    </div>
</div>