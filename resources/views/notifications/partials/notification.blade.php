<div class="notification {{ !($notification->isFollow()) ? 'show-post' : '' }}" id="notification">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar" src="{{ $notification->from()->photo }}" alt="Generic placeholder image">
        </a>
    </div>
    <div class="media-body">
        <p>{!! $notification->getHtmlText() !!} </p>

        @if(!$notification->isFollow())
            <p>{!!   $notification->regarding()->htmlText() !!}</p>
        @else
        @endif
        <div class="notification-footer">
            <ul class="list-inline list-unstyled action-list">
                @if(!$notification->isFollow())
                    @include('posts.partials.actions', ['post' => $notification->regarding()->post,'showComments' => true, 'comment' => $notification->regarding()])
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
