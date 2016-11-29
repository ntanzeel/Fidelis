<div class="notification {{ !($notification->isFollow()) ? 'show-post' : '' }}" id="notification">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar" src="{{ $notification->from()->photo }}" alt="Generic placeholder image">
        </a>
    </div>
    <div class="media-body">
        <p>{!! $notification->getHtmlText() !!} </p>

        @if(!$notification->isFollow() and !$notification->isVote())
            <p>{!!   $notification->regarding()->htmlText() !!}</p>
        @else
        @endif
        <div class="notification-footer">
            <ul class="list-inline list-unstyled action-list">
                @if(!$notification->isFollow() and !$notification->isVote())
                <li>
                    <a role="button" class="action action-like"><i class="fa fa-thumbs-up"></i></a>
                </li>
                <li>
                    <a role="button" class="action action-like"><i class="fa fa-thumbs-down"></i></a>
                </li>
                <li>
                    {{ $notification->created_at->diffForHumans() }}
                </li>
                @else
                <li>
                    {{ $notification->created_at->diffForHumans() }}
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    var userProfile = "{{ route('profile.view', ['username']) }}";
</script>
@endpush
